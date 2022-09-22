<?php

namespace Src\Controllers;
require  '././vendor/autoload.php';

use Src\Controllers\BaseController;
use Src\Services\AuthService;
use Src\Controllers\IndexController;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Src\Entities\User;

class ResetPasswordController extends BaseController
{

    public static function index()
    {
        $config = file_get_contents('config.json');
        $config = json_decode($config);
        $Security = new AuthService();
        self::init();
        $alert = false;

        if (!empty($_GET['user__mail'])){
            $GuzzleClient =  new GuzzleClient(['base_uri' => $config->AuthService->url ,'curl' => array(CURLOPT_SSL_VERIFYPEER => false)]);

            $link = self::getLink($GuzzleClient ,  $_GET['user__mail']);
            
            if ($link == false) {
                $alert = [ 'message' => 'un lien pour regénérer votre mot de passe à été envoyé'];
            } else {
                $alert = ['message' => $link[1]];
            } 
               
        }  

        return self::$twig->render(
            'password.html.twig',
            [
                'alert' => $alert,
            ]
        );
    }

    public static function reset(){
        $Security = new AuthService();
        self::init();
        $alert = false;

        if (empty($_POST['confirm__key'])) 
            $alert = ['message' => 'Le lien est defectueux'];

        if ($_POST['user__password'] != $_POST['confirm__pass'])
            $alert = ['message' => 'Les mots de passe doivent etre identiques'];
        


        return self::$twig->render(
        'reset_password.html.twig',[
                'alert' => $alert,
                'key' => $_GET['confirm__key']
            ]
            );
        
    }


    // public static function post(){
    //     $config = file_get_contents('config.json');
    //     $config = json_decode($config);
    //     $Security = new AuthService();
    //     $Client = new GuzzleClient();
    //     if (empty($_POST['confirm__key'])) {
    //         # code...
    //     }
    //     self::init();
    //     $alert = false;
    // }


    public static function updatePasssword($key , $user__mail , $user__password , GuzzleClient $GuzzleClient ) {
        try {
            $response = $GuzzleClient->post('/RESTapi/forgot' , [
                'body' => [ 'user__password' =>  $user__password ,  'confirm__key' =>  $key]
            ]);
            
        } catch (ClientException $exeption) {
            $response = $exeption->getResponse();
        }
    }


    public  static function getLink(GuzzleClient $GuzzleClient , string $email){
        
        try {
            $response = $GuzzleClient->get('/RESTapi/forgot' , [
                'query' => [ 'user__mail' =>  $email]
            ]);
            
        } catch (ClientException $exeption) {
            $response = $exeption->getResponse();
            
        }
        $message = json_decode($response->getBody()->read(1024));
   
      
        if (intval($response->getStatusCode()) != 200) 
            return false;

        return $message;
        
    }
}
