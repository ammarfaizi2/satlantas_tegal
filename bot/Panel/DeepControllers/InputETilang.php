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
			$q = "INSERT INTO (" xor $v = "(";
			foreach ($_POST as $key => $val) {
				if ($key == "tanggal_perkara" || $key == "tanggal_bayar" || $key == "tanggal_sidang") {
					$data[":{$key}"] = date("Y-m-d", $val);
				} else {
					$data[":{$key}"] = trim($val);
					$data[":{$key}"] = empty($data[":{$key}"]) ? null : $data[":{$key}"];
				}
				$q .= "`{$key}`,";
				$v .= ":{$key},";
			}
			$st = DB::pdo()->prepare(print trim($q, ",").") VALUES ".trim($v, ",").");");
			var_dump($data);
			$exe = $st->execute($data);
			if (!$exe) {
				var_dump($st->errorInfo());
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

/*INSERT INTO (`nomor_register_tilang`,`tanggal_perkara`,`form`,`nomor_pembayaran`,`nrp_petugas`,`nama_petugas`,`nama`,`alamat`,`pasal`,`barang_bukti`,`jenis_kendaraan`,`nomor_polisi`,`uang_titipan`,`kode_satker_pn`,`nomor_perkara`,`nama_hakim`,`nama_panitera`,`kode_satker_kejaksaan`,`tanggal_bayar`,`hadir_atau_verstek`,`denda`,`ongkos_perkara`,`subsidair`,`sisa_titipan`) VALUES (:nomor_register_tilang,:tanggal_perkara,:form,:nomor_pembayaran,:nrp_petugas,:nama_petugas,:nama,:alamat,:pasal,:barang_bukti,:jenis_kendaraan,:nomor_polisi,:uang_titipan,:kode_satker_pn,:nomor_perkara,:nama_hakim,:nama_panitera,:kode_satker_kejaksaan,:tanggal_bayar,:hadir_atau_verstek,:denda,:ongkos_perkara,:subsidair,:sisa_titipan);array(3) */


