<?php
namespace Src\Services;
require  '././vendor/autoload.php';
use GuzzleHttp\Client;
use Src\Entities\User;
use GuzzleHttp\Exception\ClientException;
Use Src\Services\MappingServices;
use stdClass;

class AuthService {

    private $Client;
    private $Config;

    public function __construct(){
      
        $this->Config = file_get_contents('config.json');
        $this->Config = json_decode($this->Config);
        $this->Client =  new Client(['base_uri' => $this->Config->AuthService->url ,'curl' => array(CURLOPT_SSL_VERIFYPEER => false)]);
    }

    public function logIn($username , $password){
        
        try {
            $response = $this->Client->post('/RESTapi/login',  ['json' => ['user__mail' => $username, 'user__password' => $password]]);
          
            
        } catch (ClientException $exeption) {
            $response = $exeption->getResponse();
           
        }
        if (intval($response->getStatusCode()) != 200) 
           return $response;
        
        $user = $this->loginHandler($response);
        return $user;
    }

    public function confirmUser($confirm__key, $confirm__user){
        try {
            $response = $this->Client->get('/RESTapi/confirm/user?confirm__key='.$confirm__key.'&confirm__user='.$confirm__user.'');
            
        } catch (ClientException $exeption) {
            $response = $exeption->getResponse();
         
        }
       return $response;
    }

    public function loginHandler($response){
        $mappingService = new MappingServices();
        if (intval($response->getStatusCode()) == 200 ) {
            $response = json_decode($response->getBody()->read(1024));
            try {
                $user = $this->Client->get('/RESTapi/user', ['headers' => $this->makeHeaders($response)]);
                
            } catch(ClientException $exeption) {
                $user = $exeption->getResponse();
            }
            
            if (intval($user->getStatusCode()) == 200) {
                $user = json_decode($user->getBody()->read(1024));
                $user = $mappingService->map($user[0],User::class);
                if ($user instanceof User) {
                    return $user;
                }
            }else{
               $error = [
                    'code' => intval($user->getStatusCode()), 
                    'message' => 'Identifiants invalides'
               ];
               return $error;
            }
        }else{
            $message = 'un Problème est survenu nous ne parvenons pas a joindre le serveur ' ; 
            if (intval($response->getStatusCode()) == 401) 
               $message = 'Identifiant invalides';
            
            $error = [
                'code' => intval($response->getStatusCode()),
                'message' =>  $message
            ];
            return $error;
        }
    }

    public function makeHeaders($response){
        
        $headers = ['Authorization' => 'Bearer ' . $response[0]->token, 'Accept' => 'application/json'];
        return $headers;
    }

    public function makeHeadersUser( User $user){
        
        $headers = ['Authorization' => 'Bearer ' . $user->getToken(), 'Accept' => 'application/json'];
        return $headers;
    }

    public function logOut(){

    }

    public function refresh($refresh_token){
        try {
            $token = $this->Client->post('/RESTapi/refresh', ['json' => ['refresh_token' => $refresh_token]]);
        } catch (ClientException $exeption) {
        
            $token = $exeption->getResponse();
        }
        if (intval($token->getStatusCode()) != 200) {
            return false;
        }
        $token = json_decode($token->getBody()->read(1024));
       
        return $token->token;
    }

    public function autoRefresh( $user){
        $mappingService = new MappingServices();

        if (!$user instanceof User)
            return false;

        if (empty($user->getRefresh_token()))
            return false;

        $token = [];
        $obj = new stdClass();
        $obj->token =  $this->refresh($user->getRefresh_token());
        array_push($token , $obj);
        try {
            $user = $this->Client->get('/RESTapi/user', ['headers' => $this->makeHeaders($token)]);
            
        } catch(ClientException $exeption) {
            $user = $exeption->getResponse();
        }
       
        if (intval($user->getStatusCode()) == 200){
            
            $user = json_decode($user->getBody()->read(1024));
            $user = $mappingService->map($user[0],User::class);
            if ($user instanceof User) {
                return $user;
            }
            return false;
        }
        return false;
    }

    public function guard($user){
        if (!$user instanceof User) {
            $user = '';
           return false ;
        }
        return true ;
    }

    
    protected function errorHandler(){

    }

}