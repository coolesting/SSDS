<?php /* Smarty version 2.6.26, created on 2010-09-05 14:49:54
         compiled from archive.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'archive.html', 16, false),)), $this); ?>
<table id="archive">
	<thead>
	<tr><th>
		<span>Archive</span>
		<a class="text_right" href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
earchive/">new archive</a>
	</th>
	</tr>
	</thead>

	<tbody>
	<?php if ($this->_tpl_vars['archive']): ?>
		<?php $_from = $this->_tpl_vars['archive']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['archive'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['archive']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['myaid'] => $this->_tpl_vars['v']):
        $this->_foreach['archive']['iteration']++;
?>
		<tr>
		<td class="td_left">
			<a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
topic/aid_<?php echo $this->_tpl_vars['myaid']; ?>
/
			"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')); ?>
</a>
			<span class="gray">(<?php echo $this->_tpl_vars['v']['topic_count']; ?>
)</span>
			<span>,&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')); ?>

			</span>
		</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
		<tr><td>No archive , you should create one .</td></tr>
	<?php endif; ?>
	</tbody>
</table>