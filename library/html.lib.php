<?php defined('SS_PATH') or die('No permission to access.');
/*
// a html class for auto make the template of view
*/

class SS_HTML {

	private $data_format = array();
	private $page_format = array();
	private $part_format = array();

	function __construct($arg1,$arg2,$arg3) {
		$this->data_format = $arg1;
		$this->page_format = $arg2;
		$this->part_format = $arg3;
	}

	function make_page($page = NULL) {
		if( array_key_exists($page, $this->page_format) === TRUE ) {
		} else {
			return 'Sorry, no this page as ' . $page . ' had not created .';
		}
	}
}

?>
