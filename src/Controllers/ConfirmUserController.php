<?php

namespace Src\Controllers;
require  '././vendor/autoload.php';

use Src\Controllers\BaseController;
use Src\Services\AuthService;
use Src\Controllers\IndexController;
use Src\Entities\User;

class ConfirmUserController extends BaseController
{

    public static function index()
    {

        $Security = new AuthService();
        self::init();
        $alert = false;

        if (empty($_GET['confirm__key'])) 
            $alert = 'Le lien est deffectueux '; 
    
        if (empty($_GET['confirm__user'])) 
            $alert = 'Le lien est deffectueux '; 

        if ($alert == false )
            $confirm = $Security->confirmUser($_GET['confirm__key'] , $_GET['confirm__user'] );
        
       
        $alert = json_decode($confirm->getBody());

       
        return self::$twig->render(
            'confirm.html.twig',
            [
                'alert' => $alert,
                'user' => $_SESSION['user']
            ]
        );
    }

    
}
