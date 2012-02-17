<?php /* Smarty version 2.6.26, created on 2010-09-01 17:55:48
         compiled from message.html */ ?>
<?php if ($this->_tpl_vars['link']): ?>
What you want , now ?
<ol>
	<?php $_from = $this->_tpl_vars['link']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	<li>
		<a href="<?php echo $this->_tpl_vars['v']; ?>
"><?php echo $this->_tpl_vars['k']; ?>
</a>
	</li>
	<?php endforeach; endif; unset($_from); ?>
</ol>
<?php endif; ?>