<?php
require "vendor/autoload.php";
// require "src/Controllers/indexController.php";


use Src\Controllers\IndexController as index;
$test = new  Src\Controllers\IndexController();
var_dump($test);

$request = $_SERVER['REQUEST_URI'];
$getRequest = explode('?' ,$request, 2);

if (isset($get_request[1])) 
	$getData = '?' . $getRequest[1];

if (!isset($getRequest[1])) 
	$getData = '';

$globalRequest = $getRequest[0] . $getData; 

switch ($globalRequest){
    case '/mvcStatelless/':
        echo index::index();
        break;
    
    default:
        header('HTTP/1.0 404 not found');
        echo  index::error404();
        break;
}

