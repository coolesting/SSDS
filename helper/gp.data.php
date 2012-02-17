<?php defined('SS_PATH') or die('No permission to access.');
	
/* 
 * gp data of the view layer that will need to be load in the first time 
 *
 */


//html property
$html_property['doctype'] = array('html5','html4','html3');
$html_property['color']  = '';
$html_property['background']  = '';
$html_property['z-index'] = '';
$html_property['tof'] = array('true','false');


//a panel called tool
$html_panel['tool']['main']['systempart'] = array('list'  , 'table');
$html_panel['tool']['main']['systempart'] = array('block' , 'label');
$html_panel['tool']['main']['systempart'] = array('form'  , 'menu');

$html_panel['tool']['page']['head']['pagename']		= 'new_1';
$html_panel['tool']['page']['head']['doctype']		= $html_property['doctype'];
$html_panel['tool']['page']['head']['xmlns']		= 'defalut';
$html_panel['tool']['page']['head']['charset']		= 'utf-8';
$html_panel['tool']['page']['head']['title']		= '';
$html_panel['tool']['page']['head']['description']	= '';
$html_panel['tool']['page']['head']['jslink']		= '';
$html_panel['tool']['page']['head']['csslink']		= '';
$html_panel['tool']['page']['head']['icon']			= '';
$html_panel['tool']['page']['body']['onload']		= '';
$html_panel['tool']['page']['body']['color']		= $html_property['color'];
$html_panel['tool']['page']['body']['background']	= $html_property['background'];
$html_panel['tool']['page']['body']['z-index']		= $html_property['z-index'];

$html_panel['tool']['base']['config']['hostname']	= 'localhost';
$html_panel['tool']['base']['config']['username']	= 'root';
$html_panel['tool']['base']['config']['password']	= '168';
$html_panel['tool']['base']['config']['engine']		= 'mysql';
$html_panel['tool']['base']['setting']['state']		= $html_property['tof'];


//another panel just called name part
$html_panel['part']['html'] = array();

$html_panel['part']['data'] = array();

$html_panel['part']['style']['id'] 			= '';
$html_panel['part']['style']['class'] 		= '';
$html_panel['part']['style']['width'] 		= '';
$html_panel['part']['style']['height'] 		= '';
$html_panel['part']['style']['color'] 		= $html_property['color'];
$html_panel['part']['style']['background']	= $html_property['background'];


//get the head menu of html panel
foreach($html_panel as $key => $val) {
	foreach($val as $k => $v) {
		$html_head[$key][] = $k;
	}
}
?>
