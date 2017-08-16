<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>Input Jadwal</title>
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
			return '<tr><td><select name="tgl'+i+'"><?php print self::genDate(); ?></select></td><td><input type="text" name="lokasi'+i+'"></td><td><select name="pk_awalj'+i+'"><?php print self::genPkJam(); ?></select><select name="pk_awalm'+i+'"><?php print self::genPkMenit(); ?></select></td><td><select name="pk_akhirj'+i+'"><?php print self::genPkJam(); ?></select><select name="pk_akhirm'+i+'"><?php print self::genPkMenit(); ?></select></td>';
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
	<a href="?pg=jadwal_<?php print $type; ?>_keliling&ref=input"><button class="nv">Kembali ke Jadwal <?php print strtoupper($type); ?> Keliling</button></a><button class="nv" id="add_row">Tambahkan baris</button>
</div>
<form method="post" action="?pg=jadwal_<?php print $type; ?>_keliling&post=ok">
<div class="tbcg">
<table border="1">
	<thead>
		<tr><th colspan="5">Input Jadwal <?php print strtoupper($type); ?> Keliling</th></tr>
		<tr><th>Hari/Tanggal</th><th>Lokasi</th><th>Pukul Awal</th><th>Pukul Akhir</th></tr>
	</thead>
	<tbody id="wq">
	</tbody>
</table>
</div>
<div class="sv">
	<button>Simpan</button>
</div>
</form>
</center>
</body>
</html>