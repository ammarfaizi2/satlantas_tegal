<?php
use Models\Jadwal;
if (isset($_GET['delete_jadwal'])) {
    Jadwal::delete_jadwal($_GET['delete_jadwal']);
    header("location:?pg=jadwal_sim_keliling");
    die(1);
} elseif (isset($_GET['edit_jadwal'])) {
    Panel\DeepControllers\EditJadwal::run($_GET['edit_jadwal']);
    die(1);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Jadwal SIM Keliling</title>
	<style type="text/css">
		table {
			margin-top: 4%;
			border-collapse: collapse;
		}
		th {
			padding: 2px 4px 2px 4px;
		}
		td {
			padding: 2px 15px 2px 15px;
		}
	</style>
</head>
<body>
<center>
<div>
	<a href="?ref=pg_sq"><button>Kembali</button></a>
	<a href="<?php pg("sp=input") ?>"><button>Input Jadwal</button></a>
</div>
    <?php
    if ($a = Jadwal::getJadwal()) {
        $i = 1;
        ?>
     <table border="1">
      <thead>
       <tr><th>No.</th><th>Hari/Tanggal</th><th>Lokasi</th><th>Pukul Awal</th><th>Pukul Akhir</th><th>Aksi</th></tr>
      </thead>
        <?php
        $toindo = function ($time) {
            
            $time = strtotime($time);
            $indoday = array(
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jum'at",
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
            return $indoday[date("w", $time)].",&nbsp;".date("d", $time)." ".$indomonth[date("M", $time)]." ".date("Y", $time);
        };
        foreach ($a as $val) {
            ?>
          <tr><td align="center"><?php print $i++; ?></td><td align="center"><?php print $toindo($val['tanggal']); ?></td><td align="center"><?php print $val['lokasi']; ?></td><td align="center"><?php print substr($val['pukul_awal'], 0, 5); ?></td><td align="center"><?php print substr($val['pukul_akhir'], 0, 5); ?></td><td><a href="<?php pg("delete_jadwal=".$val['id_jadwal']); ?>"><button>Hapus</button></a>&nbsp;<a href="<?php pg("edit_jadwal=".$val['id_jadwal']); ?>"><button>Edit</button></a></td></tr>
        <?php
        }
        ?>
     </table>
        <?php
    } else {
        ?>
     <div class="no_c">
      <h2 class="hd">Belum ada jadwal</h2>
     </div>
        <?php
    }
    ?>
</center>
</body>
</html>