<?php

namespace Panel;

use Panel\Login;
use SysHandler\DB;
use Panel\DeepControllers\ETilang;
use Panel\DeepControllers\DataBNN2;
use Panel\DeepControllers\ErrorPage;
use Panel\DeepControllers\JadwalSimKeliling;

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
		if (!isset($_GET['pg'])) {
			require __DIR__.'/../views/panel_index.php';
		} else {
			switch (strtolower($_GET['pg'])) {
				case 'jadwal_sim_keliling':
						$app = new JadwalSimKeliling();
						$app->run();
					break;
				case 'data_bnn2':
						$app = new DataBNN2();
						$app->run();
					break;
				case 'etilang':
						$app = new ETilang();
						$app->run();
					break;
				default:
						$app = new ErrorPage();
						$app->run(404);
					break;
			}
		}
	}
}