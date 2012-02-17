<?php

$temp->data['y'] = isset($temp->data['_args']['y']) ? $temp->data['_args']['y'] : date('Y');
$temp->data['m'] = isset($temp->data['_args']['m']) ? $temp->data['_args']['m'] : date('n');
$temp->data['d'] = isset($temp->data['_args']['d']) ? $temp->data['_args']['d'] : date('j');
$temp->data['url'] = $temp->data['_urls']['page'];
$temp->data['url_format'] = 'y_%y/m_%m/d_%d/';

//add the log to database if existing the submit
if( isset($_POST['worklog']) ) {
	$sql_worklog = '
		insert ss_worklog(
			uid, wtext, wyear, wmonth, wday, wtime
		)values(
			' . $temp->data['_user']['uid'] . ' ,
			\'' . $_POST['worklog']['text'] . '\' ,
			' . $temp->data['y'] . ' ,
			' . $temp->data['m'] . ' ,
			' . $temp->data['d'] . ' ,
			' . $current_time . '
		);
	';
	$db->execute($sql_worklog);
}

//get the data to display 
$sql_worklog = '
	select u.username, w.wtext, w.wtime 
	from ss_worklog as w, ss_user as u 
	where 
		w.wyear = '. $temp->data['y'] .' and 
		w.wmonth = '. $temp->data['m'] .' and 
		w.wday = '. $temp->data['d'] .' and
		w.uid = u.uid and
		w.uid = '. $temp->data['_user']['uid'] .'
	;
';

$temp->data['worklog'] = $db->fetch($sql_worklog);

?>
