<?php defined('SS_PATH') or die('No permission to access.');
/*
// filter input data of user , match the value of form with regular expression
*/

$input_data_patter = array(
	'post' => array(
		'title' => '/[.]{1,}/',
		'content' => '/[.]{1,}/',
	),
);

$output_data_format = array(
	'creatime' => 'date(\'Y-m-d H:i:s\',$row["creatime"])',
	'lastime'  => 'date(\'Y-m-d H:i:s\',$row["lastime"])',
	'content'  => 'nl2br($row["content"])',
);


?>
