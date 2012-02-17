<?php defined('SS_PATH') or die('No permission to access.');

if( !isset($model) ) {
	$model = array();
	$model = ss_cache('archive');
}
if( !$model ) {
	//echo 'update archive';
	//if no cache, then get this data from database
	$sql = 'select * from ss_archive';

	if( $result = $db->fetch($sql) ) {
		foreach($result as $archive) {
			$model[$archive['aid']] = array(
				'name' => $archive['name'],
				'description' => $archive['description'],
				'topic_count' => $archive['topic_count']
			);
		}
	
		//put date into cache
		ss_cache('archive', var_export($model, TRUE));
	} else {
		$model = FALSE;
	}
}
$temp->data['archive'] = $model;
?>
