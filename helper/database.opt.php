<?php defined('SS_PATH') or die('No permission to access.');


function ss_createdatabase() {
	global $db,$_tmp,$_post;
	if( !empty($_post['dbname']) ) {
		if( $db->create_db($_post['dbname']) ) {
			$_tmp['msg']  = 'Succeed to create database.'; 
		}
	}
}

function ss_createtable() {
	global $db,$_tmp,$_post;
	if( isset($_post['sql']) && !empty($_post['sql']) ) {
		$db->doit($_post['sql']);
	}
}
?>
