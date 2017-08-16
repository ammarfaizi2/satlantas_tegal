<?php

namespace Models;

use PDO;
use SysHandler\DB;

class BBN2
{
	public static function getAll()
	{
		$st = DB::pdo()->prepare("SELECT * FROM `data_bbn2`;");
		$st->execute();
		return $st->fetchAll(PDO::FETCH_ASSOC);
	}
}