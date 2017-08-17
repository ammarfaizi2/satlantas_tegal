<!DOCTYPE html>
<html>
<head>
	<title>ETilang</title>
	<style type="text/css">
		h2 {
			font-family: Arial;
		}
		.impt {
			margin-top: 4%;
			border: 3px solid black;
			width: 30%;
		}
		.impq {
			margin-top: 4%;
			margin-bottom: 20%;
			border: 3px solid black;
			width: 30%;
		}
	</style>
</head>
<body>
<center>
	<h1>ETilang</h1>
	<form method="post" enctype="multipart/form-data">
	<div class="impt">
		<h3>Import Data</h3>
		<input type="file" name="db"><br><br>
		<select name="ftype">
			<option value="PHPExcel_Reader_Excel5">Excel 5</option>
			<option value="PHPExcel_Reader_Excel2007">Excel 2007</option>
			<option value="PHPExcel_Reader_Excel2003XML">Excel 2003</option>
		</select><br><br>
		<input type="submit" name="import" value="Import"><br><br>
	</div>
	<div class="impq">
		<h3>Hapus data berdasarkan tanggal sidang</h3>
		<select name="fhapus">
			<?php print Panel\DeepControllers\JadwalSIMKeliling::genDateWg("", false); ?>
		</select><br><br>
		<div>
			Semua data mulai dari tanggal tersebut dan sebelumnya akan dihapus<br><br>
		</div>
		<input type="submit" name="delete" value="Submit"><br><br>
	</div>
	</form>
</center>
</body>
</html>