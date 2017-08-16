<?php

namespace Models;

use PDO;
use SysHandler\DB;

class Jadwal
{
    public static function getJadwal()
    {
        $st = DB::pdo()->prepare("SELECT * FROM `jadwal_sim_keliling` ORDER BY `tanggal` ASC;");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete_jadwal($id)
    {
    	return DB::pdo()->prepare("DELETE FROM `jadwal_sim_keliling` WHERE `id_jadwal`=:id LIMIT 1;")->execute(array(":id"=>$id));
    }
}
