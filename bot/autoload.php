<?php
require __DIR__.'/core/system.php';
date_default_timezone_set("Asia/Jakarta");
spl_autoload_register(
    function ($class) {
        include __DIR__."/".str_replace("\\", "/", $class).".php";
    }
);
