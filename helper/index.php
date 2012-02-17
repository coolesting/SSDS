<?php defined('SS_PATH') or die('No permission to access.');

//url
$_urls['god_main'] = $_urls['main'] . DS . 'gp' . DS;
$_urls['god_map']  = $_urls['main'] . DS . 'gp' . DS . $_func . DS;

//view
$_tmp['page'] = $_func;
$_tmp['view'] = isset($_args[0]) ? $_args[0] : '';

//post
if( isset($_POST['god'][$_func]) && !empty($_POST['god'][$_func]) && file_exists(SS_GOD . $_func . '.opt.php') ) {
	$_post = $_POST['god'][$_func];
	require_once SS_GOD . $_func . '.opt.php';
	if( isset($_post['opt']) ) {
		$opt = 'ss_' . $_post['opt'];
		if( function_exists($opt) ) {$opt();}
	}
}

//load the data for view layer
require_once SS_GP . 'gp.data.php';

//load the language package for view template 
require_once SS_GP . 'gp.lang.php';

//load the view of html template
require_once SS_GP . 'gp.html.php';
?>
