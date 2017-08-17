<?php
use SysHandler\DB;

if (isset($_POST['simpan'])) {
    $st = DB::pdo()->prepare("UPDATE `data_bbn2` SET `nopol`=:nopol, `nama`=:nama, `alamat`=:alamat, `jenis_kendaraan`=:jenken, `no_rangka`=:no_rang, `status`=:status WHERE `nopol`=:npid LIMIT 1;");
    $exe = $st->execute(
        array(
            ":nopol" => $_POST['nopol'],
            ":nama" => $_POST['nama'],
            ":alamat" => $_POST['alamat'],
            ":jenken" => $_POST['jenis_kendaraan'],
            ":no_rang" => $_POST['no_rangka'],
            ":status" => $_POST['status'],
            ":npid" => $_GET['edit_bbn2']
        )
    );
    $alert = $exe ? "Berhasil mengubah data!" : "Gagal mengubah data!"; ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<script type="text/javascript">
			alert("<?php print $alert; ?>");
			window.location = "?pg=data_bbn2";
		</script>
	</head>
	<body>
	
	</body>
	</html>
    <?php
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit BBN2</title>
</head>
<body>
<?php 
if ($st['status'] == "sedang proses") {
    $rad = '<input type="radio" name="status" value="sedang proses" checked>Sedang Proses<br><input type="radio" name="status" value="sudah selesai">Sudah Selesai';
} else {
    $rad = '<input type="radio" name="status" value="sedang proses">Sedang Proses<br><input type="radio" name="status" value="sudah selesai" checked>Sudah Selesai';
}
?>
<center>
	<div style="margin-top:2%;">
		<a href="?pg=data_bbn2"><button>Kembali ke Data BBN2</button></a>
	</div>
	<div style="margin-top: 1%;">
		<form method="post" action="">
		<table border="5" style="border-collapse: collapse;">
			<tr><td>Nopol</td><td><input type="text" name="nopol" value="<?php print $st['nopol']; ?>"></td></tr>
			<tr><td>Nama</td><td><input type="text" name="nama" value="<?php print $st['nama']; ?>"></td></tr>
			<tr><td>Alamat</td><td><input type="text" name="alamat" value="<?php print $st['alamat']; ?>"></td></tr>
			<tr><td>Jenis Kendaraan</td><td><input type="text" name="jenis_kendaraan" value="<?php print $st['jenis_kendaraan']; ?>">
			</td></tr>
			<tr><td>No Rangka</td><td><input type="text" name="no_rangka" value="<?php print $st['no_rangka']; ?>"></td></tr>
			<tr><td>Status</td><td><?php print $rad; ?></td></tr>
			<tr><td colspan="2" align="center">
				<div style="margin-top:3%;margin-bottom:3%;">
					<input type="submit" name="simpan" value="Simpan">
				</div>
			</td></tr>
		</table>
		</form>
	</div>
</center>
</body>
</html>