<?php

namespace Panel;

use Panel\Login;
use SysHandler\DB;
use Panel\DeepControllers\ETilang;
use Panel\DeepControllers\DataBNN2;
use Panel\DeepControllers\ErrorPage;
use Panel\DeepControllers\JadwalSIMKeliling;
use Panel\DeepControllers\JadwalSAMSATKeliling;

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
        include __DIR__.'/../helpers/pg.php';
        if (!isset($_GET['pg'])) {
            include __DIR__.'/../views/panel_index.php';
        } else {
            switch (strtolower($_GET['pg'])) {
            case 'jadwal_samsat_keliling':
                    $app = new JadwalSAMSATKeliling();
                    $app->run();
                break;
            case 'jadwal_sim_keliling':
                    $app = new JadwalSIMKeliling();
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
