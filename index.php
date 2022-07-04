<?php
use src\Controllers\BaseController;


$request = $_SERVER['REQUEST_URI'];
$getRequest = explode('?' ,$request, 2);

if (isset($get_request[1])) 
	$getData = '?' . $getRequest[1];

if (!isset($getRequest[1])) 
	$getData = '';

$globalRequest = $getRequest[0] . $getData; 

switch ($globalRequest){
    case '/baseName/':
        echo BaseController::basePage();
        break;
    
    default:
        header('HTTP/1.0 404 not found');
        echo BaseController::error404();
        break;
}