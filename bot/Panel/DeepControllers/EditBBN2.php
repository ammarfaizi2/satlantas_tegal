<?php

namespace Panel\DeepControllers;

use PDO;
use SysHandler\DB;

class EditBBN2
{
    public static function run($nopol)
    {
        $st = DB::pdo()->prepare("SELECT * FROM `data_bbn2` WHERE `nopol`=:nopol LIMIT 1;");
        $st->execute(
            array(
                ":nopol" => $nopol
            )
        );
        if ($st = $st->fetch(PDO::FETCH_ASSOC)) {
            include __DIR__."/../../views/edit_bbn2.php";
        } else {
            header("location:?pg=data_bbn2");
            die(1);
        }
    }
}
