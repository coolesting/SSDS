<?php /* Smarty version 2.6.26, created on 2010-09-05 15:39:37
         compiled from login.html */ ?>
<ul>
	<form action="<?php echo $this->_tpl_vars['_urls']['main']; ?>
login/" method="post">
		<li>username + password : <span class="gray">(as johs+123456)</span></li>
		<li>
			<input type="text" name="login[userpawd]" />
			<input type="submit" value=" login " />
		</li>
	</form>
	<li><a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
register/">Register</a></li>
</ul>