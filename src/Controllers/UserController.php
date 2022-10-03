<?php

namespace Src\Controllers;
require  '././vendor/autoload.php';

use Src\Controllers\BaseController;
use Src\Services\AuthService;
use Src\Controllers\IndexController;
use Src\Entities\User;

class UserController extends BaseController{

    public static function create(){
        self::init();
        return self::$twig->render(
            'createUser.html.twig',[
    
            ]
        );
    }

    public static function list(){
        self::init();
        return self::$twig->render(
            'listUser.html.twig',[
    
            ]
        );

    }
    

}