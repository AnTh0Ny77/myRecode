<?php
namespace Src\Controllers;
require  '././vendor/autoload.php';
use Src\Controllers\BaseController;

Class IndexController extends BaseController
{

    public static function index(){
        self::init();
        
    }

    public static function error404(){
        self::init();
    }
   
}