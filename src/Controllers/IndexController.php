<?php
namespace Src\Controllers;
require  '././vendor/autoload.php';
use Src\Controllers\BaseController;
use Src\Services\AuthService;
use Src\Entities\User;

Class IndexController extends BaseController
{
    
    public static function index(){
       
        $Security = new AuthService();
        self::init();
        $alert = false ;

        if (!empty($_POST['user__mail']) && !empty($_POST['user__password'])) 
            $user =  $Security->login($_POST['user__mail'] , $_POST['user__password'] );
          
            
        if (!empty($user ) and !$user instanceof User) 
            $alert = [ "message" => json_decode($user->getBody()->read(1024))[1] , 'username' =>  $_POST['user__mail'] , 'password' =>   $_POST['user__password']];

        if (!empty($user) and $user instanceof User) 
            $_SESSION['user'] =  $user;

        if (isset($_SESSION['user']) and $_SESSION['user'] instanceof User) 
            return header('location: home');
        
          
        return self::$twig->render(
            'login.html.twig',[
                'alert' => $alert
            ]
        );
        
    }

    public static function logout(){

        $_SESSION['user'] = '';
        return header('location: login');
    }

    public static function error404(){
        self::init();
        var_dump('404');
    }
   
}