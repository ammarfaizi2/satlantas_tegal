<?php

namespace Panel\DeepControllers;

use SysHandler\DB;
use Models\BBN2 as MB;

class BBN2
{
    public function __construct()
    {
    }

    public function run()
    {
        $this->__run();
    }

    private function __run()
    {
        if (isset($_GET['sp']) and $_GET['sp'] == "input") {
            $this->input();
        } else {
            include __DIR__."/../../views/bbn2_index.php";
        }
    }

    private function input()
    {
        if (isset($_POST['save'])) {
            $i = 1;
            $flag = false;
            $query = "INSERT INTO `data_bbn2` (`nopol`, `nama`, `alamat`, `jenis_kendaraan`, `no_rangka`, `status`) VALUES ";
            while (isset($_POST['nopol'.$i], $_POST['nama'.$i], $_POST['alamat'.$i], $_POST['jenis_kendaraan'.$i], $_POST['no_rangka'.$i], $_POST['status'.$i])) {
                $query .= " (:nopol{$i}, :nama{$i}, :alamat{$i}, :jenis_kendaraan{$i}, :no_rangka{$i}, :status{$i}),";
                $data[":nopol{$i}"] = $_POST['nopol'.$i];
                $data[":nama{$i}"] = $_POST['nama'.$i];
                $data[":alamat{$i}"] = $_POST['alamat'.$i];
                $data["jenis_kendaraan{$i}"] = $_POST['jenis_kendaraan'.$i];
                $data["no_rangka{$i}"] = $_POST['no_rangka'.$i];
                $data[":status{$i}"] = $_POST['status'.$i];
                $i++;
                $flag = true;
            }
            if ($flag) {
                $st = DB::pdo()->prepare(trim($query, ",").";");
                $exe = $st->execute($data);
                $alert = $exe ? "Berhasil menambahkan data!" : "Gagal menambahkan data!"; ?>
				<!DOCTYPE html>
				<html>
				<head>
					<title></title>
					<script type="text/javascript">
						alert('<?php print $alert; ?>');
						window.location = "?pg=data_bbn2";
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
						alert('Data kosong !');
						window.location = "";
					</script>
				</head>
				<body>
				
				</body>
				</html>
				<?php

            }
        } else {
            include __DIR__."/../../views/input_bbn2.php";
        }
    }
}
