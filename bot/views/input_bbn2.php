<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>Input BBN2</title>
	<style type="text/css">
		th {
			padding: 2px 5px 2px 5px;
		}
		td {
			padding: 2px 5px 2px 5px;
		}
		table {
			border-collapse: collapse;
		}
		.ab {
			margin-top: 1%;
		}
		.sv {
			margin-top: 2%;
		}
		.tbcg {
			margin-top: 10px;
		}
		.nv {
			margin-left: 5px;
			margin-right: 5px;
		}
	</style>
	<script type="text/javascript">
		var i = 1;
		function genform(i)
		{
			return '<tr><td><input type="text" name="nopol'+i+'"></td><td><input type="text" name="nama'+i+'"></td><td><input type="text" name="alamat'+i+'"></td><td><input type="text" name="jenis_kendaraan'+i+'"></td><td><input type="text" name="no_rangka'+i+'"></td><td><input type="radio" name="status'+i+'" value="sedang proses">Sedang Proses<br><input type="radio" name="status'+i+'" value="sudah selesai">Sudah Selesai</td></tr>';
		}
		window.onload = function(){
			document.getElementById('wq').innerHTML += genform(i);
			document.getElementById('add_row').addEventListener("click", function(){
				document.getElementById('wq').innerHTML += genform(++i);
			});
		}
	</script>
</head>
<body>
<center>
<div class="ab">
	<a href="?pg=data_bbn2"><button class="nv">Kembali ke Data BBN2</button></a><button class="nv" id="add_row">Tambahkan baris</button>
</div>
<form method="post" action="?pg=data_bbn2&sp=input&post=ok">
<div class="tbcg">
<table border="3">
	<thead>
		<tr><th colspan="5">Input Data BBN2</th></tr>
		<tr><th>Nopol</th><th>Nama</th><th>Alamat</th><th>Jenis Kendaraan</th><th>No Rangka</th><th>Status</th></tr>
	</thead>
	<tbody id="wq">
	</tbody>
</table>
</div>
<div class="sv">
	<input type="submit" name="save" value="Simpan">
</div>
</form>
</center>
</body>
</html>