<?php
define("CORE", __DIR__."/core");
define("STORAGE", __DIR__."/storage");
require __DIR__.'/core/system.php';
date_default_timezone_set("Asia/Jakarta");
function load_class_aaa($class) {
        include __DIR__."/".str_replace("\\", "/", $class).".php";
    }
spl_autoload_register(
    "load_class_aaa"
);
