<?php
if (isset($_GET['delete'])) {
	$st = SysHandler\DB::pdo()->prepare("DELETE FROM `tilang` WHERE `nomor_register_tilang`=:noreg LIMIT 1;");
	$exe = $st->execute(array(
			":noreg" => $_GET['delete']
		));
	if (isset($_GET['page'])) {
		$pg = (int) $_GET['page'];
	} else {
		$pg = 1;
	}
	if ($exe) {
		$c = $st->rowCount();
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title></title>
			<script type="text/javascript">
			<?php
			if ($c) {
				?>
				alert("Berhasil menghapus data");
				<?php
			} else {
				?>
				alert("Data tidak ada !");
				<?php
			}
			?>
				window.location="?pg=etilang_fr&page=<?php print $pg; ?>";
			</script>
		</head>
		<body>
		
		</body>
		</html>
		<?php
	} else {
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title></title>
			<script type="text/javascript">
				alert("<?php print $st->errorInfo(); ?>");
				window.location="?pg=etilang_fr&page=<?php print $pg; ?>";
			</script>
		</head>
		<body>
		
		</body>
		</html>
		<?php
	}
}
$pdo = SysHandler\DB::pdo() xor $a = "assets/users/";
$sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM `tilang`;");
$sql2->execute();
$get_jumlah = $sql2->fetch(PDO::FETCH_NUM);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Daftar Tilang</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
		.align-middle{
			vertical-align: middle !important;
		}
		.wq {
			padding: 10px 20px 10px 20px;
			border: 2px solid white;
			border-radius: 2%;
		}
		.wdd:hover{
			background-color: #E7E0E0;
		}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-inverse" role="navigation">
		<center>
			<div class="container-fluid" style="margin-left: 47%;margin-top: 1%;margin-bottom:2%;">
				<div class="navbar-header">
				<div style="margin-top:2%;">
					<a href="??pg=etilang&amp;rs=<?php print rstr(72); ?>"><button class="wq btn-primary">Kembali</button></a>
				</div>
				</div>
			</div>
		</center>
		</nav>
		<center>
			<div>
				<a href="?pg=input_etilang"><button class="btn btn-success">Input Data</button></a>
			</div>
			<div style="margin-bottom: 2%;">
				<h2>Daftar Tilang</h2>
			</div>
		</center>
		<?php
		if ($get_jumlah[0] == 0) {
			?>
			<center>
			<div style="margin-top: 8%;">
				<h1 style="font-weight: bold;">Tidak ada permohonan masuk</h1>
			</div>
			</center>
			<?php
			die();
		}
		?>
		<div style="padding: 0 15px; margin-bottom: 4%;">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="active"><th><center>No.</center></th><th><center>Tanggal Sidang</center></th><th style="padding-left: 5px;padding-right: 5px;"><center>Nopol</center></th><th><center>No Register Tilang</center></th><th><center>Aksi</center></th></tr>
					<?php
					$page = (isset($_GET['page']))? (int)$_GET['page'] : 1;
					$limit = 5; // Jumlah data per halamannya
					$offset = ($page - 1) * $limit;
					$sql = $pdo->prepare("SELECT `nomor_register_tilang`,`nomor_polisi`,`tanggal_sidang` FROM `tilang` ORDER BY `nomor_polisi` LIMIT {$offset},{$limit};");
					$sql->execute();
					$num = 1;
					$no = $offset + 1;
					while($val = $sql->fetch(PDO::FETCH_ASSOC)){
						?>
						<tr>
						<td class="align-middle text-center" width="4%;" align="center"><?php print $no; ?></td>
						<td class="align-middle text-center" width="10%;" align="center"><?php print date("d F Y", strtotime($val['tanggal_sidang'])); ?></td>
						<td class="align-middle text-center" width="20%;" align="center"><?php print $val['nomor_polisi']; ?></td>
						<td class="align-middle text-center" width="20%;" align="center"><?php print $val['nomor_register_tilang']; ?></td>
						<td class="align-middle text-center" width="30%;" align="center">
							<div style="margin-top:3.1px;margin-bottom:3px;">
								<a href="?pg=etilang_fr&amp;page=1&amp;delete=<?php print $val['nomor_register_tilang']; ?>"><button class="btn btn-danger">Hapus</button></a>
							</div>
						</td>
						</tr>

					<?php
						$no++; // Tambah 1 setiap kali looping
					}
					?>
				</table>
			</div>
			<center>
			<ul class="pagination">
				<?php
				if($page == 1){
				?>
					<li class="disabled"><a href="#">First</a></li>
					<li class="disabled"><a href="#">&laquo;</a></li>
				<?php
				}else{
					$link_prev = ($page > 1)? $page - 1 : 1;
				?>
					<li><a href="?pg=etilang_fr&amp;page=1">First</a></li>
					<li><a href="?pg=etilang_fr&amp;page=<?php echo $link_prev; ?>">&laquo;</a></li>
				<?php
				}
				$jumlah_page = ceil($get_jumlah[0] / $limit);
				$jumlah_number = 4;
				$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
				$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
				for($i = $start_number; $i <= $end_number; $i++){
					$link_active = ($page == $i)? ' class="active"' : '';
				?>
					<li<?php echo $link_active; ?>><a href="?pg=etilang_fr&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php
				}
				?>
				<?php
				if($page == $jumlah_page){
				?>
					<li class="disabled"><a href="#">&raquo;</a></li>
					<li class="disabled"><a href="#">Last</a></li>
				<?php
				}else{
					$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
				?>
					<li><a href="?pg=etilang_fr&amp;page=<?php echo $link_next; ?>">&raquo;</a></li>
					<li><a href="?pg=etilang_fr&amp;page=<?php echo $jumlah_page; ?>">Last</a></li>
				<?php
				}
				?>
			</ul>
			</center>
		</div>
	</body>
</html>

