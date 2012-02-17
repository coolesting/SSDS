<?php defined('SS_PATH') or die('No permission to access.');

$temp->data['title'] = $temp->data['navigation'] = 'Archive';

//get the archive
require_once SS_MOD . 'archive.mod.php';

//get the topic
$sql_topic_where = '';

//by the aid to get topic
if( isset( $temp->data['_args']['aid'] ) && 
	!empty( $temp->data['_args']['aid'] ) &&
	isset( $temp->data['archive'] )
) {
	$sql_topic_where .= ' where aid = ' . $temp->data['_args']['aid'];
	$temp->data['title'] = $temp->data['archive'][$temp->data['_args']['aid']]['name'] .
		' ' . $temp->data['archive'][$temp->data['_args']['aid']]['description'];
}

/*
//search topic
if( isset($_POST['search']) && !empty($_POST['search']) ) {
	if( !empty($sql_topic_where) )
		$sql_topic_where .= ' and';
	$sql_topic_where .= ' subject like \'%' . $_POST['search'] . '%\'';
}
 */

$sql_topic = '
	select tid, aid, author, last_reply_user, subject, altertime, post_count, views
	from ss_topic
	' . $sql_topic_where . '
	order by altertime desc 
	limit 30
';

$temp->data['topic'] = $db->fetch($sql_topic);
?>
