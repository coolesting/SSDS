<?php defined('SS_PATH') or die('No permission to access.');


$temp->data['title'] = $temp->data['navigation'] = 'Repling , now';
$temp->data['_args']['pid'] = isset($temp->data['_args']['pid']) ?
			$temp->data['_args']['pid'] : 0;

if( isset($_POST['reply']) ) {

	//add post
	$sql_reply = '
		insert ss_post(
			tid, uid, reply_pid, email, contents, startime, lastime
		)
		values(
			\'' . $temp->data['_args']['tid'] . '\' ,
			\'' . $temp->data['_user']['uid'] . '\' ,
			\'' . $temp->data['_args']['pid'] . '\' ,
			\'' . $_POST['reply']['email'] . '\' ,
			\'' . $_POST['reply']['contents'] . '\' ,
			\'' . $current_time . '\' ,
			\'' . $current_time . '\'
		);
	';

	$db->execute($sql_reply);

	//update topic information
	$db->execute('update ss_topic set 
		post_count = post_count+1, 
		altertime = ' . $current_time . '
		where tid = ' . $temp->data['_args']['tid']
	);

	$temp->data['msg']	= 'Reply succesful';
	$temp->data['link']	= array(
		'back to topic'		=> $_POST['link'],
		'back to archive'	=> $temp->data['_urls']['main'] . 'archive/'
	);
}


?>
