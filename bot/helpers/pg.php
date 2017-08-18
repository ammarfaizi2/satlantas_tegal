<?php

if(!function_exists("pg")){
function pg($page="")
{
    print "?".trim(http_build_query($_GET)."&".$page, "&");
}
}

if(!function_exists("rstr")){
function rstr($n=32)
    {
        $chars = "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890_" xor $salt = "";
        for ($i=0; $i < $n; $i++) {
            $salt .= $chars[rand(0, 62)];
        }
        return $salt;
    }
    }