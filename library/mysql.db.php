<?php defined('SS_PATH') or die('No permission to access.');

/*
// define the database object, use the SS_DB, and extended it with mysql , mysqli or others.
*/

extension_loaded('mysql') or die('Cannot loaded the mysql extension.');

class SS_MYSQL {

	/*
	// note : define the method that must be like mysqli method , 
	// such as copy the method name, then rewrite the method code ,
	// bacause the SS_DB object will be get the method as same as it gets the extension class
	*/

	protected $dbhost = 'localhost';
	protected $dbname = '';
	protected $dbuser = 'root';
	protected $dbpawd = '168';

	protected $link_id = 0;
	private   $link_tiemout = 1;
	private   $link_start_time = 0;
	
	private   $affected_rows = 0;
	private   $available_rows = 0;

	private   $select_db = TRUE;

	function __construct() {
		$this->set_db_config();
	}

	function connect() {
		if( !$this->link_id = @mysql_connect($this->dbhost,$this->dbuser,$this->dbpawd) )	
			exit('Could not connect :' . mysql_error());
		
		if( $this->select_db === TRUE ) $this->select_db();	

		mysql_query("SET NAMES 'utf8'") or die('Something wrong, ' . mysql_error());
		$this->link_start_time = time();
	}

	function query($sql) {
		if( !$this->link_id ) $this->connect();
		$result = mysql_query($sql,$this->link_id);
		if( $this->available_rows = @mysql_num_rows($result) ) return $result;
		return FALSE;
	}

	function fetch($sql, $type = 'ASSOC') {
		if( $result = $this->query($sql) ) {
			$fetch_result = $type === 'ASSOC' ? 'mysql_fetch_assoc' : 'mysql_fetch_array';
			while( $row = $fetch_result($result) ) {
				$res[] = $row;
			}
			return $res;
		}
		return FALSE;
	}

	function fetch_row($result) {
		return mysql_fetch_row($result);
	}

	function fetch_one($sql) {
		if( $result = $this->query($sql) ) 
			if( $row = mysql_fetch_row($result) ) return $row[0];
		return FALSE;
	}

	function get_table_list() {
		if( !$this->link_id ) $this->connect();
		$table_info = array(); $i = $j = 0;
		if( $result = mysql_list_tables($this->dbname, $this->link_id) ) {
			if( $rows = mysql_num_rows($result) ) {
				while( $i < $rows ) {
					$table_name  = mysql_tablename($result, $i++);
					$res = mysql_list_fields($this->dbname, $table_name, $this->link_id);
					if( $cols = mysql_num_fields($res) ) {
						while( $j < $cols ) {
							$table_info[$table_name][] = mysql_field_name($res, $j++);
						}
						$j = 0;
					}
				}
			}
		}
		if( !empty($table_info) ) return $table_info;
		return FALSE;
	}

	function execute($sql) {
		if( !$this->link_id ) $this->connect();
		mysql_query($sql) or die('Error, select database is failure. <br>' . $sql); //need to fix
		$this->affected_rows = mysql_affected_rows();
		return $this->affected_rows;
	}

	function set_db_config($dbhost = SS_HOST,$dbuser = SS_USER,$dbpawd = SS_PAWD,$dbname = SS_NAME) {
		$this->dbhost = $dbhost;
		$this->dbuser = $dbuser;
		$this->dbpawd = $dbpawd;	
		$this->dbname = $dbname;
	}

	function select_db($dbname = NULL) {
		if( $dbname === NULL) {
			$dbname = $this->dbname;
		}
		if( !$this->select_db = mysql_select_db($dbname, $this->link_id) ) {
			exit(mysql_error());
		}
		return TRUE;
	}

	function create_db($dbname) {
		$this->select_db = FALSE;
		if( !$this->link_id ) $this->connect();
		mysql_query('CREATE DATABASE `' . $dbname . '` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;');
		if( !$this->select_db = mysql_select_db($dbname, $this->link_id) )
		   	exit('Create database is failure.');
		return TRUE;
	}

	function db_info() {
		if( !$this->link_id ) $this->connect();
		$res = mysql_list_dbs($this->link_id);
		while( $row = mysql_fetch_object($res) ) {
			$result[] = $row->Database;	
		}
		return $result;
	}

	function db_current() {
    	$r = mysql_query("SELECT DATABASE()") or die(mysql_error());
    	return mysql_result($r,0);
	}

}
?>
