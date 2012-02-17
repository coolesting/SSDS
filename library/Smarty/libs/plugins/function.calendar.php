<?php

function smarty_function_calendar($parmas, &$smarty) {

	//init default data by getting something from assign $_tpl_vars 
	$year		= isset($smarty->_tpl_vars['y']) ? $smarty->_tpl_vars['y'] : date('Y');
	$month		= isset($smarty->_tpl_vars['m']) ? $smarty->_tpl_vars['m'] : date('n');
	$day		= isset($smarty->_tpl_vars['d']) ? $smarty->_tpl_vars['d'] : date('j');


	$cal_cssid	= isset($parmas['cal_cssid']) ? 
			' id="' . $parmas['cal_cssid'] . '" ' : '';

	$url_format	= isset($smarty->_tpl_vars['url_format']) ? //y=%y&m=%m&d=%d
			$smarty->_tpl_vars['url_format'] : 'y_%y/m_%m/d_%d/';

	$url		= isset($smarty->_tpl_vars['url']) ? //default is null
			$smarty->_tpl_vars['url'] : '';


	$url_y_pre	= str_replace(array('%y','%m','%d'), array($year-1,$month,$day),
			$url.$url_format);
	$url_y_next	= str_replace(array('%y','%m','%d'), array($year+1,$month,$day),
			$url.$url_format);

	$url_m_pre	= str_replace(array('%y','%m','%d'), array($year,$month-1,$day),
			$url.$url_format);
	$url_m_next	= str_replace(array('%y','%m','%d'), array($year,$month+1,$day),
			$url.$url_format);

	$str_pos	= strpos($url_format, '%d');
	$str_end_mark	= isset($url_format[$str_pos+2]) ? $url_format[$str_pos+2] : '';
	$url_day	= str_replace(array('%y','%m','%d'.$str_end_mark),
		       	array($year,$month,''), $url.$url_format);


	//init the output about the table of calendar
	$output = '';
	$output .= '
		<table' . $cal_cssid . '><thead><tr>
		<th colspan=7>
			<a href="' . $url_m_pre . '">&nbsp;<<&nbsp;</a>&nbsp;' . 
			$month . '.' . $day . '&nbsp;<a href="' . $url_m_next . 
			'">&nbsp;>>&nbsp;</a>
			<span style="float:right">		
			<a href="' . $url_y_pre . '">&nbsp;<<&nbsp;</a>&nbsp;' . 
			$year . '&nbsp;<a href="' . $url_y_next . '">&nbsp;>>&nbsp;</a>
			</span>
		</th></tr></thead>
		<thead><tr>
			<th>Sun</th><th>Mon</th><th>Tue</th><th>Web</th>
			<th>Thu</th><th>Fri</th><th>Sat</th>
		</tr></thead>
		<tbody>
		';

	//make a table of calendar
	$day_start	= date('w', strtotime("$year-$month-1"));
	$day_num	= date('t', strtotime("$year-$month-$day"));
	$day_cur	= date('j');

	for($i=1; $i<=$day_num; $i++) {
		$days[$i] = $i;
	}

	$days = array_pad($days, -($day_start+$day_num), '&nbsp;');
	$days = array_pad($days, 42, '&nbsp;');
	$days = array_chunk($days, 7, true);

	//add information to table of calendar
	foreach($days as $weeks) {
		$output .= '<tr>';
		foreach($weeks as $value) {
			//set the highlight for clicked
			$highlight = ( isset($parmas['cur_cssid']) && $value == $day ) ?
				' id="' . $parmas['cur_cssid'] . '" ' : '';

			//set the highlight for current day
			$day_lbold = $day_rbold = '';
			if( $value == $day_cur ) {
				$day_lbold = '<b>';
				$day_rbold = '</b>';
			}

			$output	.= '<td' . $highlight . '>' . $day_lbold . '<a href="' .
				$url_day . $value . $str_end_mark . '">' . $value .
				'</a>' . $day_rbold . '</td>';
		}
		$output .= '</tr>';
	}

	$output .= '</tbody>';
	$output = '<table>' . $output . '</table>';
	return $output;
}

?>
