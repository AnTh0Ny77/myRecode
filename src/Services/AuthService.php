<?php
namespace Src\Services;
require_once  './././vendor/autoload.php';
use GuzzleHttp\Client;

class AuthService {

    private $client;

    private function __construct(){
        $this->client =  new Client(['base_uri' => 'https://foo.com/api/']);
    }

    public function logIn(){

    }

    public function logOut(){

    }

    public function refresh(){

    }

    public function guard(){

    }

    protected function setCookie(){

    }

    protected function removeCookie(){

    }

    protected function errorHandler(){

    }

}