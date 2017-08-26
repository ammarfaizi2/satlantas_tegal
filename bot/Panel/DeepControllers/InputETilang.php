<?php

namespace Panel\DeepControllers;

use PDO;
use SysHandler\DB;

class InputETilang
{
	public static function run()
	{
		if (isset($_POST['simpan'])) {
			unset($_POST['simpan']);
			$q = "INSERT INTO `tilang` (`nomor_register_tilang`, `tanggal_perkara`, `form`, `nomor_pembayaran`, `nrp_petugas`, `nama_petugas`, `nama`, `alamat`, `pasal`, `barang_bukti`, `jenis_kendaraan`, `nomor_polisi`, `uang_titipan`, `kode_satker_pn`, `nomor_perkara`, `nama_hakim`, `nama_panitera`, `kode_satker_kejaksaan`, `tanggal_sidang`, `hadir_atau_verstek`, `denda`, `ongkos_perkara`, `subsidair`, `tanggal_bayar`, `sisa_titipan`) VALUES (:nomor_register_tilang,:tanggal_perkara,:form,:nomor_pembayaran,:nrp_petugas,:nama_petugas,:nama,:alamat,:pasal,:barang_bukti,:jenis_kendaraan,:nomor_polisi,:uang_titipan,:kode_satker_pn,:nomor_perkara,:nama_hakim,:nama_panitera,:kode_satker_kejaksaan,:tanggal_sidang,:hadir_atau_verstek,:denda,:ongkos_perkara,:subsidair,:tanggal_bayar,:sisa_titipan);";
			$_POST['tanggal_perkara'] = date("Y-m-d", $_POST['tanggal_perkara']);
			$_POST['tanggal_sidang'] = date("Y-m-d", $_POST['tanggal_sidang']);
			$_POST['tanggal_bayar'] = date("Y-m-d", $_POST['tanggal_bayar']);
			$_POST['uang_titipan'] = (int) $_POST['uang_titipan'];
			$_POST['denda'] = (int) $_POST['denda'];
			$_POST['ongkos_perkara'] = (int) $_POST['ongkos_perkara'];
			$_POST['sisa_titipan'] = (int) $_POST['sisa_titipan'];
			$st = DB::pdo()->prepare($q);
			$exe = $st->execute($_POST);
			if (!$exe) {
				echo "<pre>";
				var_dump($st->errorInfo());

				die();
			} else {
				?>
				<!DOCTYPE html>
				<html>
				<head>
					<title></title>
					<script type="text/javascript">
						alert("Berhasil menginput data!");
						window.location = "?pg=etilang_fr&rf=input";
					</script>
				</head>
				<body>
				</body>
				</html>
				<?php
				die();
			}
		}
		include __DIR__.'/../../views/input_etilang.php';
	}
}