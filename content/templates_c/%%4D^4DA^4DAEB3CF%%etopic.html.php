<?php /* Smarty version 2.6.26, created on 2010-09-01 17:43:57
         compiled from etopic.html */ ?>
<form action="<?php echo $this->_tpl_vars['_urls']['self']; ?>
" method="post">
<ul>
	<li>Topic : </li>
	<li><input type="text" name="etopic[subject]" value="" class="text_width" /></li>
	<li>The first post contents : </li>
	<li><textarea name="etopic[contents]" class="text_width text_height" ></textarea></li>
	<li><input type="hidden" name="link" value="<?php echo $this->_tpl_vars['_urls']['last']; ?>
" /></li>
	<li><input type="submit" value=" done " /></li>
</ul>
</form>