<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head><title>Make the page as a god !</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><body>
<!--tool panel start-->
<div id="SS_TOOL">
<div id="SS_TOOL_HEAD">
<?php foreach($html_head['tool'] as $h_val) {
	echo '<div id="ss_'.$h_val.'" class="SS_HEAD">'.$h_val.'</div>';
} ?>
</div>
<div id="SS_TOOL_BODY">
</div>
<dd id="SS_ROLL"> --------- ROLL --------- </dd>
</div>
<!--tool panel end-->
<div id="SS_GUIDE">
	<div id="SS_GUIDE_LEFT">
		<a class="SS_new_1 SS_CURRENT">new_1</a>
	</div>
	<div id="SS_GUIDE_RIGHT">
	<a id="SS_GUIDE_NEW">new</a>
	<a id="SS_GUIDE_SAVE">save</a>
	<a id="SS_GUIDE_CLOSE">close</a>
	<a id="SS_GUIDE_HEAD">GUIDE</a>
	</div>
</div>
<div id="SS_new_1" class="SS_PANEL"></div>
<style type="text/css">
#SS_TOOL,#SS_GUIDE div,ul,li,dl,dt,dd,table,td,th,input,select,span,label,form,p{margin:0;padding:0;}
#SS_TOOL {width:200px;float:left;text-align:center;border:1px solid #D9D9D9;background-color:#ADD8E6;position:absolute;top:0;right:0;cursor:pointer;}
#SS_TOOL dt{float:left;width:33%;}#SS_TOOL dd{clear:both;}
#SS_TOOL .list_head{background-color:#ebeff9;width:100%;}
#SS_TOOL table{width:100%;border-collapse:collapse;border-style:none;cursor:auto;}
#SS_TOOL td{vertical-align:text-top;border:1px solid #D9D9D9;width:50%;background-color:#ffffff;text-align:center;}
#SS_TOOL #msg{font-style:oblique;border:1px solid #97FFFF;color:#104E8B;}
#SS_TOOL .hide{display:none;}
#SS_TOOL .focus{background-color:#ebeff9;}
#SS_GUIDE{border:1px solid #D9D9D9;position:absolute;bottom:0;left:0;width:80%;height:26px;}
#SS_GUIDE a{float:left;padding:3px 5px;border-right:1px solid #D9D9D9;border-left:1px solid #D9D9D9;display:block;cursor:pointer;}
#SS_GUIDE a:hover{background-color:#ebeff9;}
#SS_GUIDE_RIGHT{float:right;}
#SS_GUIDE_HEAD{background-color:#ADD8E6;}
.SS_PANEL{width:100%;height:100%;}
</style>
<script type="text/javascript" src="http://localhost/ssds/content/view/jq.js"></script>
<script type="text/javascript">
var jq = jQuery.noConflict();
jq(document).ready(function(){
	
	/* var --- default config */
	var ss_speed = 500;
	var ss_page_current = 'new_1';
	var ss_part_current;
	var ss_part = ss_page = ss_guide = [];

	ss_guide = ['new_1'];
	var ss_model = {
		'part':[],
		'footer':{
			'css':'css1',
			'js':'js1'
		},
		'header':{
			'html':'html5',
			'doctype':'doctype'
		}
	};
	ss_part['list'] = {
		'style':{
			'id':'list_id',
			'name':'part_name'
		},
		'property':{
			'pagesize':10,
			'sort':true
		},
		'method':{
			'create':'disable',
			'delete':'disable',
			'modify':'disable'
		}
	}

	/* tool --- add a part */
	jq('#SS_MAIN td').click(function(){

		//get part name from tool
		ss_part_current = jq(this).text();

		//creat page
		if(typeof(ss_page[ss_page_current]) === 'undefined')
			ss_page[ss_page_current] = ss_model;
		
		//add part
		if(typeof(ss_page[ss_page_current].part[ss_part_current]) === 'undefined') {
			if(typeof(ss_part[ss_part_current]) === 'object')
				ss_page[ss_page_current].part[ss_part_current] = ss_part[ss_part_current];
			else alert('Error, no this web part');
		}

		//ss_page[ss_page_current].part[ss_part_current].id = 'new  id';

		//output part info
		jq.each(ss_page[ss_page_current].part[ss_part_current],function(type,values){
			jq.each(values,function(name,value){
				alert('type : '+type+' name : '+name+' value : '+value);
			});
		});
	});

	
	/* roll */
	jq('#SS_ROLL').toggle(
		function(){jq('#SS_TOOL').css({"top":(-jq('#SS_TOOL').height() + jq('#SS_ROLL').height())});},
		function(){jq('#SS_TOOL').css({"top":"0"});}
	);
	jq('#SS_GUIDE_HEAD').toggle(
		function(){jq('#SS_GUIDE').css({"left":(-jq('#SS_GUIDE').width() + jq('#SS_GUIDE_HEAD').width() + 10)});},
		function(){jq('#SS_GUIDE').css({"left":"0"});}
	);

	/* menu drag and drop */
	jq('.list_head').click(function(){
		jq(this).next().toggle();
	});

	/* tool tab for list */
	ss_tool_tab(0);
	function ss_tool_tab(index){
		jq('.SS_TOOL_HEAD').click(function(){
			var _index = jq(this).index();
			if(index != 0) _index = index;
			jq(this).addClass('focus').siblings().removeClass('focus');
			jq('.SS_TOOL_BODY').hide();
			jq('.SS_TOOL_BODY:eq('+_index+')').show();
		});
	}
});
</script></body></html>
