<?php defined('SS_PATH') or die('No permission to access.');

//if selected the category of the archive
if( isset($temp->data['_args']['aid']) && !empty($temp->data['_args']['aid']) ) {

	$temp->data['title'] = $temp->data['navigation'] = 'Editing topic, now';

	//submit the data to database for add topic
	if( isset($_POST['etopic']) ) {

		// create topic
		$sql_topic = '
			insert ss_topic(
				uid, aid, author, last_reply_user, subject, altertime, post_count, views
			)
			values(
				\'' . $temp->data['_user']['uid'] . '\' ,
				\'' . $temp->data['_args']['aid'] . '\' ,
				\'' . $temp->data['_user']['name'] . '\' ,
				\'' . $temp->data['_user']['name'] . '\' ,
				\'' . $_POST['etopic']['subject'] . '\' , 
				\'' . $current_time . '\' ,
				0,
				0
			);
		';
	
		$db->execute($sql_topic);

		// addition post
		$sql_post = '
			insert ss_post(
				tid, uid, reply_pid, email, contents, startime, lastime
			)
			values(
				last_insert_id() ,
				\'' . $temp->data['_user']['uid'] . '\' ,
				0 ,
				\'' . $temp->data['_user']['email'] . '\' ,
				\'' . $_POST['etopic']['contents'] . '\' ,
				\'' . $current_time . '\' ,
				\'' . $current_time . '\'
			);
		';

		$db->execute($sql_post);
		
		//update archive 
		$db->execute('update ss_archive set 
			topic_count = topic_count+1 
			where aid = ' . $temp->data['_args']['aid']
		);
		$model = FALSE;
		require_once SS_MOD . 'archive.mod.php';

		//output message for this operation
		$temp->data['msg'] = 'Success to editing topic .';
		$temp->data['link']	= array(
			'back to archive'	=> $temp->data['_urls']['main'] . 'archive/'
		);
	}
} else {
	header('Location: ' . $temp->data['_urls']['main'] . 'sarchive/');
}

?>
