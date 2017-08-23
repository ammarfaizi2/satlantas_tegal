<?php

namespace Panel\DeepControllers;

use SysHandler\DB;

class ETilang
{
    public function run()
    {
    	if (isset($_POST['import'])) {
    		if ($_FILES and !empty($_FILES['db']['name'])) {
    			$importer = $_POST['ftype'];
    			move_uploaded_file($_FILES['db']['tmp_name'], STORAGE."/".$_FILES['db']['name']);
    			self::import($importer, STORAGE."/".$_FILES['db']['name']);
    		}
    	} elseif (isset($_POST['delete'])) {
    		$st = DB::pdo()->prepare("DELETE FROM `tilang` WHERE `tanggal_sidang` <= :tgl");
    		$exe = $st->execute(array(":tgl" => date("Y-m-d", $_POST['fhapus'])));
    		if ($exe) {
    			$st = $st->rowCount();
    			if ($st > 0) {
    				echo "Penghapusan berhasil ! $st data dihapus";
					?>
					<script type="text/javascript">alert("Penghapusan berhasil ! <?php print $st; ?> data dihapus"); window.location=""</script>
	    			<?php
    			} else {
    				echo "Tidak ada tanggal yang sesuai";
					?>
					<script type="text/javascript">alert("Tidak ada tanggal yang sesuai"); window.location=""</script>
	    			<?php
    			}
    		} else {
    			var_dump($st->errorInfo());
    		}

    	}
        require __DIR__."/../../views/tilang_index.php";
    }



    private static function import($excel_class, $file)
    {
    	ini_set("display_errors", true);
    	ini_set("memory_limit", "999G");
    	ini_set("max_execution_time", false);
    	spl_autoload_unregister(
    			"load_class_aaa"
			);
		
		#require CORE."/simple_vendor_map/PHPExcel/PHPExcel/Settings.php";
    	require CORE."/simple_vendor_map/PHPExcel/PHPExcel.php";
    	\PHPExcel_Settings::setZipClass(\PHPExcel_Settings::PCLZIP);
    	$excelreader = new $excel_class();
		$loadexcel = $excelreader->load($file);
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

		$i = 0;
		$query = "INSERT INTO `tilang` (`nomor_register_tilang`, `tanggal_perkara`, `form`, `nomor_pembayaran`, `nrp_petugas`, `nama_petugas`, `nama`, `alamat`, `pasal`, `barang_bukti`, `jenis_kendaraan`, `nomor_polisi`, `uang_titipan`, `kode_satker_pn`, `nomor_perkara`, `nama_hakim`, `nama_panitera`, `kode_satker_kejaksaan`, `tanggal_sidang`, `hadir_atau_verstek`, `denda`, `ongkos_perkara`, `subsidair`, `tanggal_bayar`, `sisa_titipan`) VALUES ";
		foreach ($sheet as $row) {
			if ($i>0) {
				$j = 0;
				$query .= "(";
				foreach ($row as $key => $col) {
					if ($key == "AA") {
						break;
					}
					if ($j > 0) {
						$query .= ":col_{$i}_{$j},";
						if ($j == 2 || $j == 19 || $j == 24) {
							$col = explode("/", $col);
							if (isset($col[2])) {
								$data[":col_{$i}_{$j}"] = $col[2]."-".$col[1]."-".$col[0];
							} else {
								$data[":col_{$i}_{$j}"] = null;
							}
						} else {
							$data[":col_{$i}_{$j}"] = $col;
						}
					}
					$j++;
				}
				$query = trim($query, ",")."),\n\n";
			}
			$i++;
		}
		$st = DB::pdo()->prepare(trim(trim($query), ",").";");
		$exe = $st->execute($data);
		spl_autoload_register('load_class_aaa');
		if (!$exe) {
			var_dump($st->errorInfo());
		} else {
			echo "Import berhasil !";
			?>
			<script type="text/javascript">alert("Import berhasil"); window.location=""</script>
			<?php
		}
    }
}
