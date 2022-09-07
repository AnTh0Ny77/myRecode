<?php
require "vendor/autoload.php";
use Src\Controllers\IndexController as index;
use Src\Controllers\HomeController as home;
use Src\Controllers\ClientController as client;
use Src\Controllers\ConfirmUserController as confirm;

session_start();
$request = $_SERVER['REQUEST_URI'];
$getRequest = explode('?' ,$request, 2);
$getData = null;

if (isset($get_request[1])) 
	$getData = '?' . $getRequest[1];

if (!isset($getRequest[1])) 
	$getData = '';

$config =  json_decode(file_get_contents('config.json'));
$globalRequest = $getRequest[0] . $getData; 



switch ($globalRequest){
    case $config->base->url.'/':
        echo index::index();
        break;

    case $config->base->url.'/login':
        echo index::index();
        break;

    case $config->base->url.'/home':
        echo home::index();
        break;

    case $config->base->url.'/client/update'.$getData:
        echo client::update();
        break;
    
    case $config->base->url.'/logout':
        echo index::logout();
        break;

    case $config->base->url.'/confirm':
        echo confirm::index();
        break;
    

    default:
        header('HTTP/1.0 404 not found');
       
        echo  index::error404();
        break;
}