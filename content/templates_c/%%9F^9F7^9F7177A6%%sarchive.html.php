<?php /* Smarty version 2.6.26, created on 2010-09-03 13:52:20
         compiled from sarchive.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'sarchive.html', 13, false),)), $this); ?>
<ul>
	<li>
	<table>
<?php if ($this->_tpl_vars['archive']): ?>
	<tr class="table_header">
		<th style="width:25%">Topic name</th>
		<th >Description</th>
	</tr>
	<?php $_from = $this->_tpl_vars['archive']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aid'] => $this->_tpl_vars['archive']):
?>
	<tr>
		<td class="td_left">
		<a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
etopic/aid_<?php echo $this->_tpl_vars['aid']; ?>
"
		title="<?php echo $this->_tpl_vars['archive']['name']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['archive']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')); ?>
</a>
		</td>
		<td class="td_left">
		<?php echo ((is_array($_tmp=$this->_tpl_vars['archive']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')); ?>

		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
	<tr><td>No available archive to be selected .</td></tr>
<?php endif; ?>
	</table>
	</li>
	<li>
		<a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
earchive/">Create new archive</a>
	</li>
</ul>