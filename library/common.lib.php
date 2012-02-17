<?php defined('SS_PATH') or die('No permission to access.');

/* 
// that must be loading to the programe
// the file about the filter string and define global function ,etc
*/

function ss_addslashes($args) {
	if( !defined('MAGIC_QUOTES_GPC') ) define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if( !MAGIC_QUOTES_GPC ) { 
		if( is_array($args) ) {
			foreach($args as $key => $val) {
				$args[$key] = ss_addslashes($val);
			}		
		} else {
			$args = addslashes($args);
		}
	}
	return $args;
}

/*
// through recursive to remove the empty element in multi-array
*/
function ss_remove_empty_element_array($arr) { 
	foreach($arr as $key => $val) {
		if (is_array($val)){
            ss_remove_empty_element_array($val);
        } else {
            if (trim($val) == "") unset($arr[$key]);
        }
    }
    return $arr;
}

function ss_load_db($engine = SS_DB_ENGINE) {
	static $db_class = array();
	if ( isset($db_class[$engine])) return $db_class[$engine];

	if ( file_exists(SS_LIB . $engine . '.db.php') ) require_once $engine . '.db.php';
	$db_name = 'SS_' . strtoupper($engine);
	if ( !class_exists($db_name) ) ss_showmsg('No database class ,' . $db_name);
	
	$db_class[$engine] = new $db_name();
	return $db_class[$engine];
}

function ss_get_time($stime = NULL) {
	$mtime = explode(" ", microtime());
	$etime = $mtime[1] + $mtime[0];
	if( $stime !== NULL ) 
		$etime = $etime - $stime;
	return sprintf("%.5f",$etime);
}

function ss_cache($name, $contents = NULL) {
	$path = SS_CAC . md5($name) . '.php';
	if( $contents === NULL ) {
		if( !file_exists($path)) return FALSE;
		require_once $path;

		//timeout, return false
		if( date('z') > ($cache_start_date + $cache_run_date) ) return FALSE;
		if( date('z') < $cache_start_date ) return FALSE;

		//back the cache contents
		return $cache_contents;
	} else {
		if( file_exists($path) ) unlink($path);
		if( file_put_contents(
			$path, 
			'<?php $cache_start_date = ' . date('z') .
			'; $cache_run_date = 1 ;' .
			'$cache_contents = ' . $contents . '; ?>'
		) ) return TRUE;
	}
	return FALSE;
}

function ss_showmsg($msg, $type = NULL) {
	if( $type === NULL ) {
		echo $msg;
	} elseif( $type === 'dump' ) {
		echo '<pre>';
		print_r($msg);
		echo '</pre>';
	}
	exit;
}

function ss_authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

	$ckey_length = 4;
	$key = md5($key ? $key : SS_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}
?>
