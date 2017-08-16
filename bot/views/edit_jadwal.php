<!DOCTYPE html>
<html>
<head>
	<title>Edit Jadwal</title>
	<style type="text/css">
		td {
			padding: 2px 3px 2px 3px;
		}
		.cl {
			margin-top: 3%;
			margin-bottom: 3%;
		}
	</style>
</head>
<body>
<center>
<div>
	<a href="?pg=jadwal_sim_keliling"><button>Kembali</button></a>
</div>
<?php
$pkaw = explode(":", $val['pukul_awal']);
$pkak = explode(":", $val['pukul_akhir']);
?>
<form method="post" action="">
<input type="hidden" name="id_jadwal" value="<?php print $val['id_jadwal']; ?>">
<table style="margin-top: 3%;border-collapse: collapse;" border="1">
	<tr><td>Hari/Tanggal</td><td><select name="tgl"><?php print Panel\DeepControllers\JadwalSIMKeliling::genDate($val['tanggal'], false); ?></select></td></tr>
	<tr><td>Lokasi</td><td><input type="text" name="lokasi" value="<?php print $val['lokasi']; ?>"></td></tr>
	<tr>
		<td>Pukul Awal</td>
		<td>
		<select name="pk_awal_jam"><?php print Panel\DeepControllers\JadwalSIMKeliling::genPkJam($pkaw[0]); ?></select><select name="pk_awal_menit"><?php print Panel\DeepControllers\JadwalSIMKeliling::genPkMenit($pkaw[1]); ?></select><div style="margin-top:1%;"></div>
		</td>
	</tr>
	<tr>
	<td>Pukul Akhir</td>
	<td><select name="pk_akhir_jam"><?php print Panel\DeepControllers\JadwalSIMKeliling::genPkJam($pkak[0]); ?></select><select name="pk_akhir_menit"><?php print Panel\DeepControllers\JadwalSIMKeliling::genPkMenit($pkak[1]); ?></select><div style="margin-top:1%;"></div></td></tr>
	<tr>
	<td colspan="2" align="center">
	<div class="cl">
		<input type="submit" name="simpan" value="Simpan">
	</div>
	</td></tr>
</table>
</form>
</center>
</body>
</html>