<?php /* Smarty version 2.6.26, created on 2010-09-12 12:13:04
         compiled from worklog.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'calendar', 'worklog.html', 1, false),array('modifier', 'date_format', 'worklog.html', 7, false),)), $this); ?>
<?php echo smarty_function_calendar(array('cal_cssid' => 'calendar','cur_cssid' => 'current'), $this);?>

<?php if ($this->_tpl_vars['worklog']): ?>
<table>
	<?php unset($this->_sections['worklog']);
$this->_sections['worklog']['loop'] = is_array($_loop=$this->_tpl_vars['worklog']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['worklog']['name'] = 'worklog';
$this->_sections['worklog']['show'] = true;
$this->_sections['worklog']['max'] = $this->_sections['worklog']['loop'];
$this->_sections['worklog']['step'] = 1;
$this->_sections['worklog']['start'] = $this->_sections['worklog']['step'] > 0 ? 0 : $this->_sections['worklog']['loop']-1;
if ($this->_sections['worklog']['show']) {
    $this->_sections['worklog']['total'] = $this->_sections['worklog']['loop'];
    if ($this->_sections['worklog']['total'] == 0)
        $this->_sections['worklog']['show'] = false;
} else
    $this->_sections['worklog']['total'] = 0;
if ($this->_sections['worklog']['show']):

            for ($this->_sections['worklog']['index'] = $this->_sections['worklog']['start'], $this->_sections['worklog']['iteration'] = 1;
                 $this->_sections['worklog']['iteration'] <= $this->_sections['worklog']['total'];
                 $this->_sections['worklog']['index'] += $this->_sections['worklog']['step'], $this->_sections['worklog']['iteration']++):
$this->_sections['worklog']['rownum'] = $this->_sections['worklog']['iteration'];
$this->_sections['worklog']['index_prev'] = $this->_sections['worklog']['index'] - $this->_sections['worklog']['step'];
$this->_sections['worklog']['index_next'] = $this->_sections['worklog']['index'] + $this->_sections['worklog']['step'];
$this->_sections['worklog']['first']      = ($this->_sections['worklog']['iteration'] == 1);
$this->_sections['worklog']['last']       = ($this->_sections['worklog']['iteration'] == $this->_sections['worklog']['total']);
?>
	<tr>
		<td class="td_info">
			<?php echo ((is_array($_tmp=$this->_tpl_vars['worklog'][$this->_sections['worklog']['index']]['wtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%r') : smarty_modifier_date_format($_tmp, '%r')); ?>

			, <?php echo $this->_tpl_vars['worklog'][$this->_sections['worklog']['index']]['username']; ?>

		</td>
		<td><?php echo $this->_tpl_vars['worklog'][$this->_sections['worklog']['index']]['wtext']; ?>
</td>
	</tr>
	<?php endfor; endif; ?>
</table>
<?php endif; ?>
<p>
<form action="<?php echo $this->_tpl_vars['_urls']['self']; ?>
" method="post">
	<p>
		<textarea name="worklog[text]"></textarea>
		<input type="submit" value=" done " />
	</p>
</form>
</p>
<style>
#calendar td{
	width:14%;
}
#current{
	background-color:#eee;
}
textarea{
	width:80%;
}
.td_info{
	width:28.5%;
}
</style>