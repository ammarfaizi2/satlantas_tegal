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
		return $st;
	}
}