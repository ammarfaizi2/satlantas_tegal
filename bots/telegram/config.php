<?php
define("TOKEN", "406305312:AAHhdtskFGuve5GD17dBIdMGdGf6VZo7ANU");
define("DB_HOST", "localhost");
define("DB_USER", "debian-sys-maint");
define("DB_PASS", "");
define("DB_NAME", "tegal");

file_put_contents("q.txt", json_encode(json_decode(file_get_contents("php://input"), 128)));