<?php

namespace Src\Controllers;
require  '././vendor/autoload.php';

use Src\Controllers\BaseController;
use Src\Services\AuthService;
use Src\Controllers\IndexController;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Src\Entities\Client;
Use Src\Services\MappingServices;
use stdClass;
use Src\Entities\User;

class ClientController extends BaseController
{

    public static function update()
    {
        $config = file_get_contents('config.json');
        $config = json_decode($config);
        $Security = new AuthService();
        self::init();
        $alert = false;
        $GuzzleClient =  new GuzzleClient(['base_uri' => $config->AuthService->url ,'curl' => array(CURLOPT_SSL_VERIFYPEER => false)]);
        $mappingService = new MappingServices();
        //user
        $user = $Security->autoRefresh($_SESSION['user']);
        if(!$user instanceof User)
            return IndexController::logout();
        //verif du parametre
        if (!empty($_POST['cli__id'])) 
            $_GET['cli__id'] = $_POST['cli__id']; 
        
        if (empty($_GET['cli__id'])){
            $_SESSION['alert'] = [
                "message" => 'Aucun client n a été spécifiée'
            ];
            header('location: home');
            exit;
        }

         //traitement en cas de demande de mise à jour:
         if (!empty($_POST['cli__id'])) {
            $update = self::putClient($GuzzleClient , $Security , $mappingService , $user);

            if ($update instanceof Client) {
                $user = $Security->autoRefresh($_SESSION['user']);
                $_SESSION['alert'] = [ 'message' =>  $update->getCli__nom() . ' à bien été mis à jour'];
            }
            if (!$update instanceof Client)
                $_SESSION['alert'] =   $update;
        }

        
        //requete/ exeption et verif du client 
        try {
            $response = $GuzzleClient->get('/RESTapi/client?cli__id='.$_GET['cli__id'].'' , ['headers' => $Security->makeHeadersUser($user)]);   
        } catch (ClientException $exeption) {
            $response = $exeption->getResponse();
        }

        if (intval($response->getStatusCode()) == 200) {
            $client = json_decode($response->getBody()->read(1024));
            $client = $mappingService->map($client[0],Client::class);
            if (!$client instanceof Client) {
                $_SESSION['alert'] =  [
                    "message" =>  'Un problème est survenu durant le traitement des données'
                ];
                header('location: home');
                exit;
            }
                
        }else{
            $message =json_decode($response->getBody()->read(1024));

            $alert = [
            'message' =>   $message[0],
            'status' => intval($response->getStatusCode()) 
        ];
           ;
            header('location: home');
            exit;
        }

       
        $alert = $_SESSION['alert'];
        $_SESSION['alert'] = "";
        $_SESSION['user'] = $user;

        return self::$twig->render(
            'client.html.twig',
            [
                'alert' => $alert,
                'user' => $_SESSION['user'],
                'client'=> $client
            ]
        );
    }


    public static function putClient(GuzzleClient $gz , AuthService $security  , MappingServices $Map , User $user  ){
        
        try {
            $response = $gz->put('/RESTapi/client',  [ 'headers' => $security->makeHeadersUser($user) ,
            'json' =>  $_POST ]);
            
        } catch (ClientException $exeption) {
            $response = $exeption->getResponse();
           
        }
        $message =json_decode($response->getBody()->read(1024));
        if (intval($response->getStatusCode()) != 200) {
         
             return [
                'message' =>   $message[1],
                'status' => intval($response->getStatusCode()) 
             ];
        }
        $client = $Map->map($message[1],Client::class);

        if (!$client instanceof Client) 
            return  ["message" =>  'Un problème est survenu durant le traitement des données'];

        return $client;
          
    }

}