<!DOCTYPE html>
<html>
<head>
<title>Login Autobot SATLANTAS POLRES TEGAL</title>
<style>
.lgf{
	margin-top: 30%;
	border: 3px solid black;
	border-radius: 2%;
	width:50%;
	padding-top: 1.3%;
	padding-bottom: 15%;
}
.ifp{
	margin-top:3%
}
.lgfs{
	border: 2px solid black;
	width: 65%;
	padding-bottom:10%;
	border-radius: 2%;
}
.lbt{
	margin-top:8%;
}
.hq{
	margin-top:10%;
	margin-bottom:10%;
}
</style>

</head>
<body>
<center>

<div class="lgf">
<form method="post" action="">
<div>

<div class="hq">
<h2>SATLANTAS POLRES TEGAL</h2>
</div>

<div class="lgfs">
<div>
<h2>Login</h2>
</div>

<div class="ifp">
	<div>
	<label>Username : </label>
	</div>
	<div>
	<input type="text" name="username">
	</div>
</div>

<div class="ifp">
	<div>
	<label>Password : </label>
	</div>
	<div>
	<input type="password" name="password">
	</div>
</div>

<div class="lbt">
<input type="hidden" name="tsf" value="<?php print $csrf; ?>">
<input type="hidden" name="cky" value="<?php print $ckey; ?>">
<input type="submit" name="login" value="Login">
</div>

</div>


</form>
</div>

</body>
</html>