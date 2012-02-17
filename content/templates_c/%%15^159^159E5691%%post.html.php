<?php /* Smarty version 2.6.26, created on 2010-09-05 14:53:39
         compiled from post.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'post.html', 9, false),array('modifier', 'date_format', 'post.html', 25, false),array('modifier', 'bbcode2html', 'post.html', 27, false),)), $this); ?>
<table>
	<thead>
	<tr><th>
		<span><a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
archive/">Archive</a></span>
		<?php if ($this->_tpl_vars['_args']['aid'] && $this->_tpl_vars['archive']): ?>
		<span>&nbsp;>>&nbsp;<a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
topic/aid_<?php echo $this->_tpl_vars['_args']['aid']; ?>

			/"><?php echo $this->_tpl_vars['archive'][$this->_tpl_vars['_args']['aid']]['name']; ?>
</a></span>
		<?php endif; ?>
		<span>&nbsp;>>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')); ?>
</span>
		<span class="text_right">
			<a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
etopic/
			<?php if ($this->_tpl_vars['_args']['aid']): ?>aid_<?php echo $this->_tpl_vars['_args']['aid']; ?>
/<?php endif; ?>">new topic</a>
		</span>
	</th>
	</tr>
	</thead>
	
	<tbody>
	<?php if ($this->_tpl_vars['post']): ?>
		<?php unset($this->_sections['post']);
$this->_sections['post']['loop'] = is_array($_loop=$this->_tpl_vars['post']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['post']['name'] = 'post';
$this->_sections['post']['show'] = true;
$this->_sections['post']['max'] = $this->_sections['post']['loop'];
$this->_sections['post']['step'] = 1;
$this->_sections['post']['start'] = $this->_sections['post']['step'] > 0 ? 0 : $this->_sections['post']['loop']-1;
if ($this->_sections['post']['show']) {
    $this->_sections['post']['total'] = $this->_sections['post']['loop'];
    if ($this->_sections['post']['total'] == 0)
        $this->_sections['post']['show'] = false;
} else
    $this->_sections['post']['total'] = 0;
if ($this->_sections['post']['show']):

            for ($this->_sections['post']['index'] = $this->_sections['post']['start'], $this->_sections['post']['iteration'] = 1;
                 $this->_sections['post']['iteration'] <= $this->_sections['post']['total'];
                 $this->_sections['post']['index'] += $this->_sections['post']['step'], $this->_sections['post']['iteration']++):
$this->_sections['post']['rownum'] = $this->_sections['post']['iteration'];
$this->_sections['post']['index_prev'] = $this->_sections['post']['index'] - $this->_sections['post']['step'];
$this->_sections['post']['index_next'] = $this->_sections['post']['index'] + $this->_sections['post']['step'];
$this->_sections['post']['first']      = ($this->_sections['post']['iteration'] == 1);
$this->_sections['post']['last']       = ($this->_sections['post']['iteration'] == $this->_sections['post']['total']);
?>
		<tr><td class="post">
			<p class="title">
			No P<?php echo $this->_tpl_vars['post'][$this->_sections['post']['index']]['pid']; ?>
,&nbsp;
			By <?php echo $this->_tpl_vars['post'][$this->_sections['post']['index']]['email']; ?>
,&nbsp;
			<?php echo ((is_array($_tmp=$this->_tpl_vars['post'][$this->_sections['post']['index']]['startime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a %R %P, %x") : smarty_modifier_date_format($_tmp, "%a %R %P, %x")); ?>

			<p class="contents">
				<?php echo ((is_array($_tmp=$this->_tpl_vars['post'][$this->_sections['post']['index']]['contents'])) ? $this->_run_mod_handler('bbcode2html', true, $_tmp) : smarty_modifier_bbcode2html($_tmp)); ?>

				<a class="text_right" href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
reply/
				tid_<?php echo $this->_tpl_vars['post'][$this->_sections['post']['index']]['tid']; ?>
/
				pid_<?php echo $this->_tpl_vars['post'][$this->_sections['post']['index']]['pid']; ?>
">reply</a>
			</p>
			</p>
		</td></tr>
		<?php endfor; endif; ?>
	<?php else: ?>
		<tr><td>The post is not existing , may be moved .</td></tr>
	<?php endif; ?>
	</tbody>
</table>
<ul>
<style>
.post .title{
	padding: 2px 0;
	color: #858585;
}
.post .contents{
	padding: 5px 0;
}
ol .bb-list-ordered-d { list-style-type:decimal; }
ol .bb-list-ordered-lr { list-style-type:lower-roman; }
ol .bb-list-ordered-ur { list-style-type:upper-roman; }
ol .bb-list-ordered-la { list-style-type:lower-alpha; }
ol .bb-list-ordered-ua { list-style-type:upper-alpha; }
.bb-code, .bb-quote {
  border: 1px solid #C0C0C0;
  background-color: #eeeeee;
  padding: 20px;
  margin: 20px;
  font-family: sans-serif;
}
.bb-image {
  border-width: 0;
  border-style: none;
}
</style>