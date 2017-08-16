<?php

namespace Panel;

use Panel\Login;
use SysHandler\DB;

class BotPanel
{
	/**
	 * Panel\Login
	 */
	private $login;
	
	/**
	 * Constructor.
	 */
	public function __construct(Login $login)
	{
		$this->login = $login;
	}
	
	public function run()
	{
		require __DIR__.'/../views/panel_index.php';
	}
}