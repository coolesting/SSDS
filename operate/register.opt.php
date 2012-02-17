<?php defined('SS_PATH') or die('No permission to access.');


if( isset($_POST['register']) ) {

//print_r($_POST['register']);
	//check the user if existing, or return
	if( !$db->fetch('select uid from ss_user where username = \'' .
		$_POST['register']['username'] . '\';' )) {

		$pawd = sha1($_POST['register']['username'].'+'.$_POST['register']['password']);
		$sql_register = '
			insert ss_user(
				username, password, email, creatime, lastime, level, permis
			) values (
				\'' . $_POST['register']['username'] . '\',
				\'' . $pawd . '\',
				\'' . $_POST['register']['email'] . '\',
				\'' . $current_time . '\',
				\'' . $current_time . '\',
				1,
				1
			);
		';
		
		//create user
		if( $results = $db->execute($sql_register)) {
			$temp->data['msg'] = 'Registered successfully.';
			$temp->data['link']= array(
				'Back to home page' => $temp->data['_urls']['main'] . 'home/'
			);
		}

	} else {
		//existing user, return
		$temp->data['msg'] = 'The username is existing, please try again by other.';
		$temp->data['link']= array(
			'Back to register' => $temp->data['_urls']['main'] . 'register/'
		);

	}
}

?>
