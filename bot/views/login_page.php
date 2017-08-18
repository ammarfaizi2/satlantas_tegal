<!DOCTYPE html>
<html>
<head>
<title>LOGIN AUTOBOT SATLANTAS POLRES TEGAL</title>
<style>
.lgf{
	margin-top: 3%;
	border: 3px solid black;
	border-radius: 2%;
	width:40%;
	padding-top: 1.3%;
	padding-bottom: 6%;
	background-color: white;
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
	margin-top:3%;
	margin-bottom:3%;
}
body{
	background-color: #6DC7B0;
}
</style>

</head>
<body>
<center>
<div class="lgf">
	<form method="post" action="">
		<img src="assets/logo.jpg" width="300">
		<div class="hq">
		<h2>AUTOBOT SATLANTAS POLRES TEGAL</h2>
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
					<input type="text" name="username" required>
				</div>
			</div>

		<div class="ifp">
			<div>
				<label>Password : </label>
			</div>
			<div>
				<input type="password" name="password" required>
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
</center>
</body>
</html>