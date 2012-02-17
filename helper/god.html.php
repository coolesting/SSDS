<?php defined('SS_PATH') or die('No permission to access.');
/*
 * it is a html template that is collected some html data.
 *
 * */
$html_menu = array(
	'Make Page'   => array('list','table','form','block','head','menu','foot'),
	'Make Data'   => array('sql','xml'),
	'Make Part'   => array('new','old'),
	'Admin' => array('database','setting','document'),
);

$html_map = array(
	'database' => array('createtable' => 'create table','createdatabase' => 'create database'),
);

//set default view for map
if( empty($_tmp['view']) && isset($html_map[$_func]) ) 
	$_tmp['view'] = key($html_map[$_func]); 

$html = array(
'nomodel'=> 'Sorry, no this model, please contact to admin.',
'index'  => '<li>Welcome god to here for make the page .</li>',
'name'   => '<li>name (require):</li><li><input type="text" name="god['.$_func.'][name]" class="input_style" /></li>',
'dome'   => '<li><input type="submit" value="done" class="input_style" /></li>',
'block'	 => '<li>content :</li><li><textarea name="god['.$_func.'][block]"></textarea></li>',
'sql'    => '<li>sql (advance):</li><li><textarea name="god['.$_func.'][sql]"></textarea></li>',
'opt'    => '<li><input type="hidden" name="god['.$_func.'][opt]" value="'.$_tmp['view'].'"></li>',
);

$content = '';
if( isset($_tmp['page']) ) {

	switch( $_tmp['page'] ) {

		case 'table' :
			$db = ss_load_db();
			$table_info = $db->get_table_list();

			//1 . select fields
			$content .= '<li>select (require): </li><li>'; 
			foreach($table_info as $table => $fields) {
				$content .= '<table><thead><tr><th>' . $table . '</th></tr></thead><tbody>';
				foreach($fields as $value) {
					$content .= '<tr><td>' . $value . '</td>';
					$content .= '<td><input type="checkbox" name="god['.$_func.'][field][' . $table .
								'][]" value="' . $value . '" /></td></tr>';
				}
				$content .= '</tbody></table>';
			}
			$content .= '</li>';

			//2 . where
			$content .= '<li>where :</li><li><input type="text" name="god['.$_func.'][where]" class="input_style" ></li>'; 
			//3 . limit
			$content .= '<li>limit :</li><li><input type="text" name="god['.$_func.'][limit]" class="input_style" ></li>'; 
			//4 . sql , that will cover all before
			$content .= $html['sql'];
			$content .= $html['dome'];
		break;


		case 'database' :
			$db = ss_load_db();
			$db_info = $db->db_info();
			$db_current = $db->db_current();
			
			//2 . database info
			$content .= '<li>database  info : ';
			$content .= '<select name="god['.$_func.'][dbinfo]" class="input_style">';
			foreach($db_info as $value) {
				if($db_current == $value) 
					$content .= '<option value="' . $value . '" selected><b>' . $value . ' (current)</b></option>';
				else
					$content .= '<option value="' . $value . '" >' . $value . '</option>';
			}
			$content .= '</select></li>';
			
			//it is a switch for view 
			//3 . 1 create table 
			if( $_tmp['view'] === 'createtable' ) {
				
				//3 . 2 create table, submit fields
				if( isset($_post['fields']) && !empty($_post['fields']) && $number = (int)$_post['fields'] ) {
					if( $number > 0 ) {
						$content .= '<li>table name : <input name="god['.$_func.'][tablename]" type="text" /></li>';
						$str = '<>';
					}
				} else {
					$content .= '<li>create table(utf-8), fields number : ';
					$content .= '<input name="god['.$_func.'][fields]" type="text" /></li>';
				}
			}

			//4 . create database 
			elseif( $_tmp['view'] === 'createdatabase' ) {
				$content .= '<li>create database, name is : ';
				$content .= '<input name="god['.$_func.'][dbname]" type="text" /></li>';
			}

			//5 . dome
			$content .= $html['opt'];
			$content .= $html['dome'];
		break;

		case 'sql' :
			$content .= $html['sql'];
			$content .= $html['opt'];
			$content .= $html['dome'];
		break;

		default:
			$content = $html['nomodel'];
		break;
	}
}
else $content = $html['index'];

?>
