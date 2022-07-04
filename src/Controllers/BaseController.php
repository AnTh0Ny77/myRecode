<?php

namespace src\Controllers;
require_once  '././vendor/autoload.php';


Class BaseController 
{

    protected static $twig;

	protected static function init()
	{
       
		$loader = new \Twig\Loader\FilesystemLoader('./public/template/');
       	self::$twig = new \Twig\Environment($loader, [
           'debug' => true,
           'cache' => false,
       	]);
       	self::$twig->addExtension(new \Twig\Extension\DebugExtension());
	}

   
}

