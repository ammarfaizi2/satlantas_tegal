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
			$st = DB::pdo()->prepare($quer = trim($q, ",").") VALUES ".trim($v, ",").");");
			print $quer;
			die();
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