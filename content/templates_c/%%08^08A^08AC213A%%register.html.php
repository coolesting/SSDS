<?php /* Smarty version 2.6.26, created on 2010-09-05 15:49:38
         compiled from register.html */ ?>
<ul>
	<form action="<?php echo $this->_tpl_vars['_urls']['main']; ?>
register/" method="post">
		<li>username :</li>
		<li><input type="text" name="register[username]" /></li>
		<li>password :</li>
		<li><input type="password" name="register[password]" /></li>
		<li>email :</li>
		<li><input type="text" name="register[email]" /></li>
		<li><input type="submit" value=" done " /></li>
	</form>
	<li><a href="<?php echo $this->_tpl_vars['_urls']['main']; ?>
home/">Back home page</a></li>
</ul>