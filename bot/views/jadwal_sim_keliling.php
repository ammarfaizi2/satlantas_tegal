<?php
use Models\Jadwal;
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
			padding: 2px 10px 2px 10px;
		}
	</style>
</head>
<body>
<center>
<div>
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
			foreach ($a as $val) {
				?>
					<tr><td align="center"><?php print $i++; ?></td><td align="center"><?php print $val['tanggal']; ?></td><td align="center"><?php print $val['lokasi']; ?></td><td align="center"><?php print substr($val['pukul_awal'], 0, 5); ?></td><td align="center"><?php print substr($val['pukul_akhir'], 0, 5); ?></td><td><a href="<?php pg("delete_jadwal=".$val['id_jadwal']); ?>"><button>Hapus</button></a> <a href="<?php pg("edit_jadwal=".$val['id_jadwal']); ?>"><button>Edit</button></a></td></tr>
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