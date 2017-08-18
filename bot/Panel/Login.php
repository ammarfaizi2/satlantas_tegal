<?php

namespace Panel;

use SysHandler\DB;
use Models\Login as LL;

class Login
{
    public function __construct()
    {
    }
    
    public function check_login()
    {
        if (isset($_COOKIE['user'], $_COOKIE['sess'])) {
            if (LL::check_session(base64_decode($_COOKIE['user']), base64_decode($_COOKIE['sess']))) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    
    public function login_page()
    {
        if (isset($_POST['login'])) {
            if ($a = LL::check_login($_POST['username'], $_POST['password'])) {
                $w = LL::make_session($a[1]);
                setcookie("user", base64_encode($w[0]), time()+7200);
                setcookie("sess", base64_encode($w[1]), time()+7200);
                header("Location:?login=ok");
            } else {
                header("Location:?login=failed");
            }
            die(1);
        } else {
            $this->login_pgg();
        }
    }
    
private function login_pgg()
{
	$csrf = rstr();
	$ckey = rstr(64);
	require __DIR__.'/../views/login_page.php';
}
}