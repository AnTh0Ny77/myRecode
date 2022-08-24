<?php

namespace Src\Entities;

class User{

    private $id;

    private $email;

    private $username;

    private $role;

    private $token;

    private $refresh_token;

    public function __construct($Id,$email, $username , $role , $token , $refresh_token){
        $this->setId($Id);
        $this->setEmail($email);
        $this->setUsername($username);
        $this->setRole($role);
        $this->setToken($token);
        $this->setRefresh_token($refresh_token);
    }


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;

        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;

        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;

        return $this;
    }

    public function getToken(){
        return $this->token;
    }

    public function setToken($token){
        $this->token = $token;

        return $this;
    }

    public function getRefresh_token(){
        return $this->refresh_token;
    }

    public function setRefresh_token($refresh_token){
        $this->refresh_token = $refresh_token;

        return $this;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;

        return $this;
    }
}
