<?php defined('SS_PATH') or die('No permission to access.');
/**
 * core script that need to be load in every applicate .
 */

/**
 * define path
 */
define('SS_LIB' , SS_PATH . 'library' . DS);
define('SS_OPE' , SS_PATH . 'operate' . DS);
define('SS_MOD' , SS_PATH . 'model' . DS);

define('SS_CAC' , SS_PATH . 'content' . DS . 'cache' . DS);
define('SS_TEM' , SS_PATH . 'content' . DS);
define('SS_VON' , SS_PATH . 'vonder' . DS);

define('MAGIC_QUOTES_GPC' , get_magic_quotes_gpc());	
	
/**
 * load the template 
 * notice that , we need to add the method and function to the template of default configure
 * in detail , to see variable data, and function assigni() in the Smarty.class.php
 */
require_once SS_LIB . 'Smarty/libs/Smarty.class.php';
$temp = new Smarty;
$temp->template_dir 	= SS_TEM . 'templates';
$temp->compile_dir  	= SS_TEM . 'templates_c';
$temp->cache_dir	= SS_TEM . 'cache';
//$temp->config_dir		= SS_TEM . 'configs';
$temp->compile_check = true;
//$temp->debuggin 	= true;

/**
 * common config
 * error report, load the common library, start time 
 */
error_reporting(E_ALL);
require_once SS_LIB . 'common.lib.php'; 
$current_time = time();

/**
 * global variables , commom data of the model
 */
$temp->data['_urls'] = $temp->data['_user'] = $temp->data['_args'] = array(); 
$temp->data['_page'] = 'home';
require_once SS_MOD . 'common.mod.php';

/**
 * process url , $_GET
 * url just like following ...
 * 'http://www.example.com/index.php/page/arguments ...'
 * filter the badly character, then put into variable $temp->data['_urls']
 */
if( isset($_SERVER['PATH_INFO']) && ($temp->data['_urls']['info'] = $_SERVER['PATH_INFO']) ) {
	if( strpos($temp->data['_urls']['info'] , '/') !== FALSE ) {		
		$temp->data['_urls']['info'] = str_replace(array('\'','"'),'',$temp->data['_urls']['info']);
		$temp->data['_urls'] = array_values(ss_remove_empty_element_array(explode('/' , $temp->data['_urls']['info'])));
	}
}

//set the default page
if( isset($temp->data['_urls'][0]) && !empty($temp->data['_urls'][0]) ) {
	$temp->data['_page'] = array_shift($temp->data['_urls']);
}
if( isset($temp->data['_urls']) && !empty($temp->data['_urls']) ) {
	// original array
	//$temp->data['_args'] = $temp->data['_urls'];

	// an assoc array
	foreach($temp->data['_urls'] as $key_value) {
		if( strpos($key_value, '_') ) {
			list($key, $value) = explode('_', $key_value);
			$temp->data['_args'][$key] = $value;
		} else {
			$temp->data['_args'][$key_value] = $key_value;
		}
	}
}
$temp->data['title'] = $temp->data['navigation'] = isset($temp->data['menu'][$temp->data['_page']])? $temp->data['menu'][$temp->data['_page']] : $temp->data['_page'];



/**
 * get some difference urls to $temp->data['_urls'] variable
 * the global variable of the $_SERVER need to be check if the php running by promit directly.
 * print_r($temp->data['_urls']);
 * ssds == SS_project_name , here
 */
$temp->data['_urls']['main'] = 'http://' . $_SERVER['SERVER_NAME'] . DS . 'ssds/index.php/'; 
$temp->data['_urls']['self'] = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
$temp->data['_urls']['page'] = $temp->data['_urls']['main'] . $temp->data['_page'] . DS;
$temp->data['_urls']['last'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
foreach($temp->data['_urls'] as $key => $val) {
	if( substr($val, -1) !== DS ) {
		$temp->data['_urls'][$key] .= DS;
	}
}

/**
 * filter $_POST
 * filter data for the post operation
 */
if( isset($_POST) && !empty($_POST) ) {
	require_once SS_MOD . 'filter.data.php';
	foreach($input_data_patter as $_key => $_value ) {
		if( isset($_POST[$_key]) ) {
			foreach($_value as $_keyname => $_patter ) {
				if( !preg_match($_patter, $_POST[$_key][$_keyname]) ) 
					ss_showmsg('Sorry, content cannot match.');
			}			
		}
	}
}

if( !MAGIC_QUOTES_GPC && $_FILES ) {
	$_FILES = addslashes($_FILES);
}
if( isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS']) ) {
	ss_showmsg('Badly request');
}

/**
 * load config
 * check the config.php, if no , go to install 
 */
if( file_exists(SS_LIB . 'config.php') ) {
	require_once SS_LIB . 'config.php';
} elseif(file_exists(SS_LIB . 'install.php')) {
	require_once SS_LIB . 'install.php';
	exit; 
} else {
	ss_showmsg('No install, No config, please contact the administrator');
}


/**
 * load library
 */
$db = ss_load_db();
require_once SS_LIB . 'user.lib.php';


/**
 * load the model for specify page
 */
if( file_exists(SS_MOD . $temp->data['_page'] . '.mod.php') ) {
	require_once SS_MOD . $temp->data['_page'] . '.mod.php';
	$temp->data[$temp->data['_page']] = $model;
	unset($model);
}


/**
 * check the permission for user, if no enough as guest , then go to user login page
 * or show note message.
 */
if( isset($_permis[$temp->data['_page']]) && 
	$temp->data['_user']['permis'] >= $_permis[$temp->data['_page']] 
) {
	//loading operation
	if( file_exists(SS_OPE . $temp->data['_page'] . '.opt.php') ) {
		require_once SS_OPE . $temp->data['_page'] . '.opt.php';
	}

	//loading template to display
	if( !file_exists(SS_TEM . 'templates/' . $temp->data['_page'] . '.html') )
	ss_showmsg('Sorry, no template of page as ' . $temp->data['_page']);

} else {
	if( $temp->data['_user']['name'] === 'guest' ) {
		$temp->data['title'] = $temp->data['navigation'] = $temp->data['_page'] = 'login';
	} else {
		$temp->data['title'] = $temp->data['msg'] = 'Sorry, no permission to access';
	}
}


//jump to message page if the variable $temp->data['msg'] be set 
if( isset($temp->data['msg']) ) {
	$temp->data['navigation']	= $temp->data['msg'];
	$temp->data['_page']		= 'message';
}
$temp->assigni();
$temp->display('main.html');
exit;
 
?>
