<?php

namespace Src\Controllers;
require  '././vendor/autoload.php';

use Src\Controllers\BaseController;
use Src\Services\AuthService;
use Src\Entities\User;

class HomeController extends BaseController
{

    public static function index()
    {
        $Security = new AuthService();
        self::init();
        $alert = false;

        if(!$Security->guard($_SESSION['user']))
            header('location: login');

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
