<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>

</style>
</head>
<body>
<center>
<div class="lgf">
<form method="post" action="">

<div>
	<div>
	<label>Username : </label>
	</div>
	<div>
	<input type="text" name="username">
	</div>
</div>

<div>
	<div>
	<label>Password : </label>
	</div>
	<div>
	<input type="password" name="password">
	</div>
</div>

<div>
<input type="hidden" name="tsf" value="<?php print $csrf; ?>">
<input type="hidden" name="cky" value="<?php print $ckey; ?>">
<input type="submit" name="login" value="Login">
</div>

</form>
</div>
</body>
</html>