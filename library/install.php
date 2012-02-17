<?php defined('SS_PATH') or die('No permission to access.');
	
/**
 * a install file for this program
 * 2010-9
 */

if( file_exists('config.php') ) {
	ss_showmsg('The project was installed.');
}

$config_definition = array(
	'localhost'	=> 'SS_HOST' ,
	'username'	=> 'SS_USER' ,
	'password'	=> 'SS_PAWD' ,
	'database'	=> 'SS_NAME' ,
	'securekey'	=> 'SS_SECOURE_KEY' ,
	'engine'	=> 'SS_DB_ENGINE',
	'adminuser'	=> 'SS_ADMIN_USER',
	'adminpawd' 	=> 'SS_ADMIN_PAWD',
	'adminemail'	=> 'SS_ADMIN_EMAIL',
	'website'	=> 'SS_WEBSITE'
);	

if( isset($_POST['install']) ) {
	
	//filter data of input contents
	$_POST = ss_addslashes($_POST);

	//defining the constant instead of loading the config file for database operation
	$config_content = '';
	foreach($_POST['install'] as $key => $val ) {
		$config_content .= "define('" . $config_definition[$key] 
				. "' , '" . $val . "');";
	}		

	eval($config_content);
	$db = ss_load_db();

	$sqls = array(
	//archive
	"
		CREATE TABLE IF NOT EXISTS `ss_archive` (
		`aid` int(100) NOT NULL auto_increment,
		`name` varchar(50) NOT NULL,
		`description` varchar(200) NOT NULL,
		`topic_count` int(100) NOT NULL,
		PRIMARY KEY  (`aid`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	",
	//post
	"
		CREATE TABLE IF NOT EXISTS `ss_post` (
		`pid` bigint(100) NOT NULL auto_increment,
		`tid` bigint(100) NOT NULL,
		`uid` int(100) NOT NULL,
		`reply_pid` bigint(100) NOT NULL,
		`email` varchar(50) NOT NULL,
	 	`contents` mediumtext NOT NULL,
	  	`startime` int(10) NOT NULL,
		`lastime` int(10) NOT NULL,
	  	PRIMARY KEY  (`pid`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	",
	//topic
	"
		CREATE TABLE IF NOT EXISTS `ss_topic` (
		`tid` bigint(100) NOT NULL auto_increment,
		`uid` bigint(100) NOT NULL,
		`aid` int(100) NOT NULL,
		`author` varchar(100) NOT NULL,
		`last_reply_user` varchar(100) NOT NULL,
		`subject` varchar(100) NOT NULL,
		`altertime` int(10) NOT NULL,
		`post_count` int(100) NOT NULL,
		`views` int(100) NOT NULL,
		PRIMARY KEY  (`tid`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	",
	//user
	"	
		CREATE TABLE IF NOT EXISTS `ss_user` (
		`uid` int(100) NOT NULL auto_increment,
		`username` varchar(100) NOT NULL,
		`password` varchar(100) NOT NULL,
		`email` varchar(50) NOT NULL,
		`creatime` int(10) NOT NULL,
		`lastime` int(10) NOT NULL,
		`level` tinyint(10) NOT NULL,
		`permis` tinyint(10) NOT NULL,
		PRIMARY KEY  (`uid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	",
	//worklog
	"	
		CREATE TABLE IF NOT EXISTS `ss_worklog` (
		`wid` bigint(100) NOT NULL auto_increment,
		`uid` int(100) NOT NULL,
		`wtext` text NOT NULL,
		`wyear` int(1) NOT NULL,
		`wmonth` tinyint(5) NOT NULL,
		`wday` tinyint(5) NOT NULL,
		`wtime` int(10) NOT NULL,
		PRIMARY KEY  (`wid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	"
	);

	//create database
	$db->create_db(SS_NAME);
	foreach($sqls as $sql) {
		$db->execute($sql);
	}

	$db->execute(
		"insert ss_user(
			username, password, email, creatime, level, permis
		)values(
			'guest',
			'" . sha1('guest+123456') . "',
		    'guest',
			'" . time() . "',
			0,
		   	0
		),(
			'" . SS_ADMIN_USER . "',
			'" . sha1(SS_ADMIN_USER.'+'.SS_ADMIN_PAWD) . "',
			'" . SS_ADMIN_EMAIL . "',
			'" . time() . "',
			100,
		   	100
		)"
	);

	//create config.php
	$config_content = "<?php \r\n\r" . 
		str_replace(";" , ";\r\n\r", $config_content) .
		"?>";

	file_put_contents(SS_LIB . 'config.php', $config_content);
	chmod(SS_LIB . 'config.php', 0744);

	ss_showmsg(
		'Successful installed , <a href="' .
		$temp->data['_urls']['main'] .
		'">go home page</a>'
	);	
}


?>

<div style="margin:auto;text-align:center;">
<h3>Welcome to install</h3>
</br>
<table align="center">
<tbody>
<form action="<?=$temp->data['_urls']['self']?>" method="post">
	<tr>
		<td>localhost :</td>
		<td><input type="text" name="install[localhost]" value="localhost" /></td>
	</tr>
	
	<tr>
		<td>username :</td>
		<td><input type="text" name="install[username]" value="root" /></td>
	</tr>
	
	<tr>
		<td>password :</td>
		<td><input type="password" name="install[password]" /></td>
	</tr>
	
	<tr>
		<td>database :</td>
		<td><input type="text" name="install[database]" value='ssdsx' /></td>
	</tr>
	
	<tr>
		<td>secure key :</td>
		<td><input type="text" name="install[securekey]" value="123456" /></td>
	</tr>

	<tr>
		<td>database engine :</td>
		<td>
		<select name="install[engine]">
		<option value="mysql" selected="selected">mysql</option>
		<option value="oracle">oracle</option>
		<option value="mssql">mssql</option>
		<option value="postgresql">postgresql</option>
		</select>
		</td>
	</tr>
	<tr>

	<tr>
		<td>admin username :</td>
		<td><input type="text" name="install[adminuser]" value="admin" /></td>
	</tr>

	<tr>
		<td>admin password :</td>
		<td><input type="password" name="install[adminpawd]" /></td>
	</tr>

	<tr>
		<td>admin email :</td>
		<td><input type="text" name="install[adminemail]" value="admin@admin.com" /></td>
	</tr>

	<tr>
		<td>website url :</td>
		<td><input type="text" name="install[website]" value="<?=$temp->data['_urls']['main']?>" /></td>
	</tr>

	<tr>
		<td></td><td></br><input type="submit" value=" Done " /></td>
	</tr>
</form>	
</tbody>
</table>
</div>
