<?php
require __DIR__.'/core/system.php';
date_default_timezone_set("Asia/Jakarta");
spl_autoload_register(function($class)
	{
		require __DIR__."/".str_replace("\\", "/", $class).".php";
	});