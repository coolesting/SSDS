<?php /* Smarty version 2.6.26, created on 2010-09-11 17:49:36
         compiled from main.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'main.html', 18, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head><title><?php echo $this->_tpl_vars['title']; ?>
</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<style>
ul{ list-style:none;}
</style>
<div id="wrap">
	<div id="header">
		<?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['menu']['iteration']++;
?>
			<a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
<?php echo $this->_tpl_vars['k']; ?>
/"><?php echo $this->_tpl_vars['v']; ?>
</a>
			<?php if (! ($this->_foreach['menu']['iteration'] == $this->_foreach['menu']['total'])): ?>&nbsp; | &nbsp;<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<?php if ($this->_tpl_vars['navigation']): ?>
	<div id="navigation"><h2><?php echo ((is_array($_tmp=$this->_tpl_vars['navigation'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')); ?>
</h2></div>
	<?php endif; ?>
	<div id="bodyer">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['_page']).".html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div>Power by ssds</div>
</div>
<style>
a{
	color: #000080;
	text-decoration: none;
}
a:hover{
	text-decoration: underline;
	color: black;
}
html,body,td,ul,li,p,div,h2{
	color: black;
	background-color: #ffffff;
	padding: 0;
	margin: 0;
	font:normal 14px/120% simsun;
}
li{
	padding: 4px 0;
}
p{
	padding: 2px 0;
}
table{
	width: 100%;
	border-collapse: collapse;
	border-style: none;
}
td,th{
	border: 1px solid #C0C0C0;
	padding: 4px;
}
thead{
	background-color: #eeeeee;
	text-align: left;
}
#navigation h2{
	padding: 5px 0;
	color: #000080;
	font-size : 20px;
	font-weight: bolder;
}
.text_width{
	width: 80%;
}
.text_height{
	height: 250px;
}
.text_right{
	float: right;
}
.text_left{
	float: left;
}
.td_center{
	text-align: center;
}
.bold{
	font-weight: bolder;
}
.gray{
	color: gray;
}
.tip{
	font-size: 11px;
	color: gray;
}
#header{
	background-color: #eeeeee;
}
#bodyer{
	min-height: 550px;
}
</style>
</body>
</html>