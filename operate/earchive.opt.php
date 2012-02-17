<?php defined('SS_PATH') or die('No permission to access.');
	
$temp->data['title'] = $temp->data['navigation'] = 'Editing archive, now';

if( isset($_POST['earchive']) ) {

	$sql = '
		insert ss_archive (
			name, description, topic_count
		)
		values (\'' . 
			$_POST['earchive']['name'] . '\', \'' . 
			$_POST['earchive']['description'] . '\', 0
		);
	';

	$db->execute($sql);

	//update the model by data
	$model = FALSE;
	require_once SS_MOD . 'archive.mod.php';

	//set the link of page which we will jump to
	$temp->data['msg']	= 'Success to editing archive';
	$temp->data['link']	= array(
		'new topic'	=> $temp->data['_urls']['main'] . 'etopic/',
		'continue to add'=> $temp->data['_urls']['main'] . 'earchive/'
	);
}

?>
