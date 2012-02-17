<?php /* Smarty version 2.6.26, created on 2010-09-05 14:53:56
         compiled from topic.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'topic.html', 23, false),array('modifier', 'escape', 'topic.html', 23, false),array('modifier', 'date_format', 'topic.html', 31, false),)), $this); ?>
<table>
	<thead>
	<tr><th>
		<span><a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
archive/">Archive</a></span>
		<?php if ($this->_tpl_vars['_args']['aid'] && $this->_tpl_vars['archive']): ?>
		<span>&nbsp;>>&nbsp;<?php echo $this->_tpl_vars['archive'][$this->_tpl_vars['_args']['aid']]['name']; ?>
</span>
		<span class="text_right">
			<a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
etopic/
			<?php if ($this->_tpl_vars['_args']['aid']): ?>aid_<?php echo $this->_tpl_vars['_args']['aid']; ?>
/<?php endif; ?>">new topic</a>
		</span>
		<?php endif; ?>
	</th>
	</tr>
	</thead>

	<tbody>
	<?php if ($this->_tpl_vars['topic']): ?>
		<?php $_from = $this->_tpl_vars['topic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['topic']):
?>
		<tr>
		<td><p>
			<a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
post/
				tid_<?php echo $this->_tpl_vars['topic']['tid']; ?>
/aid_<?php echo $this->_tpl_vars['topic']['aid']; ?>
/
				topic_<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['topic']['subject'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"
				title="<?php echo $this->_tpl_vars['topic']['subject']; ?>

				"><?php echo ((is_array($_tmp=$this->_tpl_vars['topic']['subject'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')); ?>
</a>
				&nbsp;&nbsp;by&nbsp;<?php echo $this->_tpl_vars['topic']['author']; ?>

		</p><p class="tip">
			No:T<?php echo $this->_tpl_vars['topic']['tid']; ?>
&nbsp;
			View:<?php echo $this->_tpl_vars['topic']['views']; ?>
&nbsp;
			Replis:<?php echo $this->_tpl_vars['topic']['post_count']; ?>
&nbsp;
			Last state:<?php echo ((is_array($_tmp=$this->_tpl_vars['topic']['altertime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a %R %P, %x") : smarty_modifier_date_format($_tmp, "%a %R %P, %x")); ?>
&nbsp;,
			<?php echo $this->_tpl_vars['topic']['last_reply_user']; ?>

		</p>
		</td></tr>
		<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
		<tr><td>No topic about the archive .</td></tr>
	<?php endif; ?>
	</tbody>
</table>