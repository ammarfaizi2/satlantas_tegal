<?php

namespace Models;

use PDO;
use core\T;
use SysHandler\DB;

class Login
{
    public static function logout_session($sess, $userid)
    {
        return DB::pdo()->prepare("DELETE FROM `admin_session` WHERE `session`=:sess AND `userid`=:userid LIMIT 1;")->execute(array(
                ":sess" => $sess,
                ":userid" => $userid
            ));
    }
    public static function check_login($user, $pass)
    {
        $st = DB::pdo()->prepare("SELECT `password`, `userid` FROM `admin` WHERE `username` = :user LIMIT 1;");
        $st->execute(
            array(
            ":user" => strtolower($user)
            )
        );
        if ($st = $st->fetch(PDO::FETCH_NUM)) {
            if (T::decrypt($st[0], "polrestegal") == $pass) {
                return $st;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    private static function genSessId()
    {
        $a = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM____--" xor $len = strlen($a)-1;
        $r = "";
        for ($i=0;$i<64;$i++) {
            $r .= $a[rand(0, $len)];
        }
        return $r;
    }
    
    public static function check_session($user, $sess)
    {
        $st = DB::pdo()->prepare("SELECT `userid`,`expired_at` FROM `admin_session` WHERE `userid`=:user AND `session`=:sess LIMIT 1;");
        $st->execute(
            array(
            ":user" => $user,
            ":sess" => $sess
            )
        );

        $st = $st->fetch(PDO::FETCH_ASSOC);
        if (isset($st['expired_at']) and (strtotime($st['expired_at']) > time())) {
            return $st;
        } else {
            return false;
        }
    }
    
    public static function make_session($userid)
    {
        $session = self::genSessId();
        $st = DB::pdo()->prepare("INSERT INTO `admin_session` (`userid`, `session`, `created_at`, `expired_at`) VALUES (:userid, :session, :cr, :ex);");
        $exe = $st->execute(
            array(
            ":userid" => $userid,
            ":session" => $session,
            ":cr" => (date("Y-m-d H:i:s")),
            ":ex" => (date("Y-m-d H:i:s", time()+(3600*24)))
            )
        );
        if (!$exe) {
            var_dump($st->errorInfo());
            die(1);
        }
        return array($userid, $session);
    }
}
