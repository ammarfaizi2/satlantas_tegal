<?php

namespace Panel\DeepControllers;

use PDO;
use SysHandler\DB;

class EditJadwal
{
    public static function run($id, $type)
    {
        self::__run($id, $type);
    }

    private static function __run($id, $type = "sim")
    {
        if (isset($_POST['simpan'])) {
            $exe = DB::pdo()->prepare("UPDATE `jadwal_{$type}_keliling` SET `tanggal`=:tgl, `lokasi`=:lokasi, `pukul_awal`=:pkaw, `pukul_akhir`=:pkak WHERE `id_jadwal`=:id LIMIT 1;")->execute(
                array(
                    ":tgl" => (date("Y-m-d", $_POST['tgl'])),
                    ":lokasi" => $_POST['lokasi'],
                    ":pkaw" => ($_POST['pk_awal_jam'].":".$_POST['pk_awal_menit']),
                    ":pkak" => ($_POST['pk_akhir_jam'].":".$_POST['pk_akhir_menit']),
                    ":id" => $_POST['id_jadwal']
                )
            );
            $alert = $exe ? "Berhasil mengedit jadwal!" : "Gagal mengedit jadwal!"; ?>
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<script type="text/javascript">
					alert('<?php print $alert; ?>');
					window.location = "?pg=jadwal_<?php print $type; ?>_keliling";
				</script>
			</head>
			<body>
			
			</body>
			</html>
    <?php
            die();
        }
        $st = DB::pdo()->prepare("SELECT * FROM `jadwal_{$type}_keliling` WHERE id_jadwal = :id LIMIT 1;");
        $exe = $st->execute(array(":id" => $id));
        if ($val = $st->fetch(PDO::FETCH_ASSOC)) {
            include __DIR__."/../../views/edit_jadwal.php";
        } else {
            header("location:?pg=jadwal_{$type}_keliling");
            die();
        }
    }
}
