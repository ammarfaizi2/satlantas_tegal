<?php

namespace Panel;

use Panel\Login;
use Panel\BotPanel;

class Run
{
	public static function run()
	{
		$a = new Login();
		if ($a->check_login()) {
			$b = new BotPanel($a);
			$b->run();
		} else {
			$a->login_page();
		}
	}
}