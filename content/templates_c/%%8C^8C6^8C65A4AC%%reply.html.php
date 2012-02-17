<?php /* Smarty version 2.6.26, created on 2010-09-03 15:55:10
         compiled from reply.html */ ?>
<form acton="<?php echo $this->_tpl_vars['_urls']['self']; ?>
" method="post">
<ul>
	<li>Contents : </li>
	<li><textarea name="reply[contents]" class="text_width text_height" ></textarea></li>
	<li>Email : </li>
	<li><input type="text" name="reply[email]" class="text_width" /></li>
	<li><input type="hidden" name="link" value="<?php echo $this->_tpl_vars['_urls']['last']; ?>
" /></li>
	<li><input type="submit" value=" done " /></li>
</ul>
</form>