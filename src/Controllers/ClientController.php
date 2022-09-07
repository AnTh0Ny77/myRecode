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
        //user
        $user = $Security->autoRefresh($_SESSION['user']);
        if(!$user instanceof User)
            return IndexController::logout();
        //verif du parametre
        if (empty($_GET['cli__id'])) {
            $_SESSION['alert'] = 'Aucun client n a été spécifiée';
            header('location: home');
            exit;
        }
        //requete/ exeption et verif du client 
        $GuzzleClient =  new GuzzleClient(['base_uri' => $config->AuthService->url ,'curl' => array(CURLOPT_SSL_VERIFYPEER => false)]);
        try {
            $response = $GuzzleClient->get('/RESTapi/client?cli__id='.$_GET['cli__id'].'' , ['headers' => $Security->makeHeadersUser($user)]);   
        } catch (ClientException $exeption) {
            $response = $exeption->getResponse();
        }

        if (intval($response->getStatusCode()) == 200) {
            $mappingService = new MappingServices();
            $client = json_decode($response->getBody()->read(1024));
            $client = $mappingService->map($client[0],Client::class);
            if (!$client instanceof User) {
                $_SESSION['alert'] = 'Un problème est survenu durant le traitement des données';
                header('location: home');
                exit;
            }
                
        }else{
            $message =json_decode($response->getBody()->read(1024));

            $_SESSION['alert'] = [
            'message' =>   $message[0],
            'status' => intval($response->getStatusCode()) 
        ];
            header('location: ../home');
            exit;
        }

        return self::$twig->render(
            'client.html.twig',
            [
                'alert' => $alert,
                'user' => $_SESSION['user'],
                'client'=> $client
            ]
        );
    }

}