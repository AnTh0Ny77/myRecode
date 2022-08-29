<?php
require "vendor/autoload.php";
use Src\Controllers\IndexController as index;
use Src\Controllers\HomeController as home;
session_start();
$request = $_SERVER['REQUEST_URI'];
$getRequest = explode('?' ,$request, 2);
$getData = null;

if (isset($get_request[1])) 
	$getData = '?' . $getRequest[1];

if (!isset($getRequest[1])) 
	$getData = '';

$config =  json_decode(file_get_contents('globalConfig.json'));
$globalRequest = $getRequest[0] . $getData; 

switch ($globalRequest){
    case $config->baseUrl->url.'':
        echo index::index();
        break;

    case $config->baseUrl->url.'/login':
        echo index::index();
        break;

    case $config->baseUrl->url.'/home':
        echo home::index();
        break;
    
    default:
        header('HTTP/1.0 404 not found');
        echo  index::error404();
        break;
}

