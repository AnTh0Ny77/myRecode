<?php

namespace Src\Controllers;
require  '././vendor/autoload.php';

use Src\Controllers\BaseController;
use Src\Services\AuthService;
use Src\Controllers\IndexController;
use Src\Entities\User;

class HomeController extends BaseController
{

    public static function index()
    {
        
        
        $Security = new AuthService();
        self::init();
        $alert = false;

        $user = $Security->autoRefresh($_SESSION['user']);
        if(!$user instanceof User)
            return IndexController::logout();

        if (!empty($_SESSION['alert'])){
            $alert = $_SESSION['alert'];
            $_SESSION['alert'] = "";
        }
            
        return self::$twig->render(
            'home.html.twig',
            [
                'alert' => $alert,
                'user' => $_SESSION['user']
            ]
        );
    }

    public static function error404()
    {
        self::init();
    }
}
