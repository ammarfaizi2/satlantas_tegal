<?php

namespace Models;

use PDO;
use SysHandler\DB;

class BBN2
{
    public static function getBBN2($nopol)
    {
        $st = DB::pdo()->prepare("SELECT * FROM `data_bbn2` WHERE `nopol`=:nopol LIMIT 1;");
        $st->execute(array(
         ":nopol" => $nopol
        ));
        return $st->fetch(PDO::FETCH_ASSOC);
    }
    public static function getAll()
    {
        $st = DB::pdo()->prepare("SELECT * FROM `data_bbn2`;");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete_bbn2($nopol)
    {
        return DB::pdo()->prepare("DELETE FROM `data_bbn2` WHERE `nopol`=:nopol LIMIT 1;")->execute(array(
                ":nopol" => $nopol
            ));
    }
}
