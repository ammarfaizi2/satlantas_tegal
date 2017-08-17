<?php
use Models\BBN2;

if (isset($_GET['delete_bbn2'])) {
    BBN2::delete_bbn2($_GET['delete_bbn2']);
    header("location:?pg=data_bbn2");
    die(1);
} elseif (isset($_GET['edit_bbn2'])) {
    Panel\DeepControllers\EditBBN2::run($_GET['edit_bbn2']);
    die(1);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data BBN2</title>
	<style type="text/css">
		table {
			margin-top: 2%;
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
<h2>Data BBN2</h2>
<div>
	<a href="?ref=pg_sq"><button>Kembali</button></a>
	<a href="<?php pg("sp=input") ?>"><button>Input Data</button></a>
</div>
    <?php
    if ($a = BBN2::getAll()) {
        $i = 1; ?>
     <table border="1">
      <thead>
       <tr><th>No.</th><th>Nopol</th><th>Nama</th><th>Alamat</th><th>Jenis Kendaraan</th><th>No Rangka</th><th>Status</th><th>Aksi</th></tr>
      </thead>
        <?php 
        foreach ($a as $val) {
            ?>
          <tr><td align="center"><?php print $i++; ?></td><td align="center"><?php print $val['nopol']; ?></td><td align="center"><?php print $val['nama']; ?></td><td align="center"><?php print $val['alamat']; ?></td><td align="center"><?php print $val['jenis_kendaraan']; ?></td><td><?php print $val['no_rangka']; ?></td><td><?php print $val['status']; ?></td><td><a href="<?php pg("delete_bbn2=".$val['nopol']); ?>"><button>Hapus</button></a>&nbsp;<a href="<?php pg("edit_bbn2=".$val['nopol']); ?>"><button>Edit</button></a></td></tr>
        <?php

        } ?>
     </table>
        <?php

    } else {
        ?>
     <div class="no_c">
      <h2 class="hd">Belum ada data</h2>
     </div>
        <?php

    }
    ?>
</center>
</body>
</html>