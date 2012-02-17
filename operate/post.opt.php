<?php defined('SS_PATH') or die('No permission to access.');

$temp->data['title'] = $temp->data['navigation'] = 'Archive';

//load archive
require_once SS_MOD . 'archive.mod.php';

//get post
if( isset($temp->data['_args']['tid']) && !empty($temp->data['_args']['tid']) ) {

	$sql_post = '
		select pid, tid, reply_pid, email, contents, startime, lastime
		from ss_post
		where tid = ' . $temp->data['_args']['tid']
	;

	$temp->data['post']  = $db->fetch($sql_post);

	//add view count
	$db->execute('update ss_topic set views = views+1 where tid = ' . $temp->data['_args']['tid']);
}

//title
if( isset($temp->data['_args']['topic']) && !empty($temp->data['_args']['topic']) ) {
	$temp->data['title'] = urldecode($temp->data['_args']['topic']);
}
?>
