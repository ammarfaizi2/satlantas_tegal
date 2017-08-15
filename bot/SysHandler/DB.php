<?php

namespace SysHandler;

class DB
{
	public static function pdo()
	{
		return new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
	}
}