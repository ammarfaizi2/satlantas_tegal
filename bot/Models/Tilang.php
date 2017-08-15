<?php

namespace Models;

use PDO;
use SysHandler\DB;

class Tilang
{
	public static function cek_tilang($no)
	{
		$st = DB::pdo()->prepare("SELECT * FROM `table_a` AS `a` INNER JOIN `table_b` AS `b` ON `a`.`no_register_tilang`=`b`.`no_register_tilang` WHERE `a`.`no_register_tilang` = :noreg OR `b`.`nomor_polisi` = :nopol LIMIT 1;");
		$st->execute([
				":noreg" => $no,
				":nopol" => $no
			]);
		$st = $st->fetch(PDO::FETCH_ASSOC);
		if (is_array($st)) {
			$wq = "";
			foreach ($st as $key => $value) {
				if ($key == "hadir") {
					$wq .= "<b>Hadir/Verstek</b> : ".htmlspecialchars($value)."\n";
				} else {
					$wq .= "<b>".ucwords(str_replace("_", " ", $key))."</b> : ".htmlspecialchars($value)."\n";
				}
			}
		} else {
			$wq = "Mohon maaf, pencarian tidak ditemukan!";
		}
		return $wq;
	}
}