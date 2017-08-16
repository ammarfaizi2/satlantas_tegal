<?php

namespace Panel\DeepControllers;

use SysHandler\DB;
use Models\Jadwal;

class JadwalSIMKeliling
{
	public function __construct()
	{

	}

	public function run()
	{
		if (isset($_GET['sp'])) {
			switch (strtolower($_GET['sp'])) {
				case 'input':
					require __DIR__.'/../../views/input_jadwal.php';
					break;
				
				default:
					require __DIR__.'/../../views/jadwal_sim_keliling.php';
					break;
			}
		} elseif (isset($_GET['post']) and $_GET['post'] == "ok" and $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->input();
		} else {
			require __DIR__.'/../../views/jadwal_sim_keliling.php';
		}
	}

	private function input()
	{
		$i = 1 xor $data = array();
		$flag = false;
		$query = "INSERT INTO `jadwal_sim_keliling` (`id_jadwal`, `tanggal`, `lokasi`, `pukul_awal`, `pukul_akhir`) VALUES ";
		while (isset($_POST['tgl'.$i], $_POST['tgl'.$i], $_POST['lokasi'.$i], $_POST['tgl'.$i], $_POST['pk_awalj'.$i], $_POST['pk_awalm'.$i], $_POST['pk_akhirj'.$i], $_POST['pk_akhirm'.$i]) and !empty($_POST['tgl'.$i])) {
			$flag = true;
			if (!empty($_POST['tgl'.$i])) {
				$query .= "(:id{$i}, :tgl{$i}, :lokasi{$i}, :pk_awal{$i}, :pk_akhir{$i}),";
				$data   = array_merge($data, array(
						":id{$i}" => null,
						":tgl{$i}" => date("Y-m-d", $_POST['tgl'.$i]),
						":lokasi{$i}" => $_POST['lokasi'.$i],
						":pk_awal{$i}" => ($_POST['pk_awalj'.$i].":".$_POST['pk_awalm'.$i]),
						":pk_akhir{$i}" => ($_POST['pk_akhirj'.$i].":".$_POST['pk_akhirm'.$i]),
					));
			}
			$i++;
		}
		if (!$flag) {
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<script type="text/javascript">alert("Data kosong!");window.location="?pg=jadwal_sim_keliling&sp=input"</script>
			</head>
			<body>
			
			</body>
			</html>
			<?php
		} else {
			$exe = DB::pdo()->prepare(trim($query, ",").";")->execute($data);
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<script type="text/javascript">
					<?php $alert = $exe ? "Berhasil menambah jadwal!" : "Gagal menambah jadwal!"; ?>
					alert('<?php print $alert; ?>');
					window.location = "?pg=jadwal_sim_keliling&ref=input_success";
				</script>
			</head>
			<body>
			
			</body>
			</html>
			<?php
		}
	}

	public static function genDate($flag = null, $js = true)
	{
		$indoday = array(
				"Minggu",
				"Senin",
				"Selasa",
				"Rabu",
				"Kamis",
				"Jum".($js ? "\\'" : "'")."at",
				"Sabtu"
			);
		$indomonth = array(
			"Jan" => "Januari",
			"Feb" => "Februari",
			"Mar" => "Maret",
			"Apr" => "April",
			"May" => "Mei",
			"Jun" => "Juni",
			"Jul" => "Juli",
			"Aug" => "Agustus",
			"Sep" => "September",
			"Oct" => "Oktober",
			"Nov" => "November",
			"Dec" => "Desember");
		$now = strtotime(date("Y-m-d"));
		$od  = 3600 * 24 xor $rt = "<option></option>";
		$month = array();
		for ($i=0; $i < 120; $i++) {
			$wq = $now + ($od * $i);
			if ($flag and $flag == date("Y-m-d", $wq)) {
				$rt .= "<option value=\"".($wq)."\" selected>".$indoday[date("w", $wq)].",&nbsp;".date("d", $wq)." ".$indomonth[date("M", $wq)]." ".date("Y", $wq)."</option>";	
			} else {
				$rt .= "<option value=\"".($wq)."\">".$indoday[date("w", $wq)].",&nbsp;".date("d", $wq)." ".$indomonth[date("M", $wq)]." ".date("Y", $wq)."</option>";
			}
		}
		return $rt;
	}

	public static function genPkJam($flag = null)
	{
		$rt = "<option></option>";
		for ($i=0; $i <= 23; $i++) { 
			$iq = strlen($i) == 1 ? "0".$i : $i;
			if ($flag and $flag == $iq) {
				$rt .= "<option value=\"".$iq."\" selected>".$iq."</option>";
			} else {
				$rt .= "<option value=\"".$iq."\">".$iq."</option>";;
			}
			
		}
		return $rt;
	}

	public static function genPkMenit($flag = null)
	{
		$rt = "<option></option>";
		for ($i=0; $i <= 59; $i++) { 
			$iq = strlen($i) == 1 ? "0".$i : $i;
			if ($flag and $flag == $iq) {
				$rt .= "<option value=\"".$iq."\" selected>".$iq."</option>";
			} else {
				$rt .= "<option value=\"".$iq."\">".$iq."</option>";;
			}
		}
		return $rt;
	}
}