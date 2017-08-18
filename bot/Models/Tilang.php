<?php

namespace Models;

use PDO;
use SysHandler\DB;

class Tilang
{
    public static function cek_tilang($no)
    {
        $st = DB::pdo()->prepare("SELECT * FROM `tilang` WHERE `nomor_register_tilang` = :noreg OR `nomor_polisi` = :nopol LIMIT 1 ");
        $st->execute(
            [
                ":noreg" => $no,
                ":nopol" => $no
            ]
        );
        $st = $st->fetch(PDO::FETCH_ASSOC);
        return $st;
    }
}
