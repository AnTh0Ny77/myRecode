<?php

namespace Src\Entities;

class User{

    public $user__id;

    public $user__nom;

    public $user__prenom;

    public $user__mail;

    public $user__service;

    public $user__fonction;

    public $user__gsm;

    public $user__memo;

    public $user__tel;

    public $user__d_creat;

    public $user__d_off;

    public $user__chrono;

    public $token;

    public $refresh_token;

    
    public function getUser__id(){
        return $this->user__id;
    }

    public function setUser__id($user__id){
        $this->user__id = $user__id;

        return $this;
    }

    public function getUser__nom(){
        return $this->user__nom;
    }

    public function setUser__nom($user__nom){
        $this->user__nom = $user__nom;

        return $this;
    }

    public function getUser__prenom(){
        return $this->user__prenom;
    }

    public function setUser__prenom($user__prenom){
        $this->user__prenom = $user__prenom;

        return $this;
    }

    public function getUser__mail(){
        return $this->user__mail;
    }

    public function setUser__mail($user__mail){
        $this->user__mail = $user__mail;

        return $this;
    }

    public function getUser__service(){
        return $this->user__service;
    }

    public function setUser__service($user__service){
        $this->user__service = $user__service;

        return $this;
    }

    public function getUser__fonction(){
        return $this->user__fonction;
    }

    public function setUser__fonction($user__fonction){
        $this->user__fonction = $user__fonction;

        return $this;
    }

    public function getUser__gsm(){
        return $this->user__gsm;
    }

    public function setUser__gsm($user__gsm){
        $this->user__gsm = $user__gsm;

        return $this;
    }

    public function getUser__memo(){
        return $this->user__memo;
    }

    public function setUser__memo($user__memo){
        $this->user__memo = $user__memo;

        return $this;
    }

    public function getUser__tel(){
        return $this->user__tel;
    }
 
    public function setUser__tel($user__tel){
        $this->user__tel = $user__tel;

        return $this;
    }

    public function getUser__d_creat(){
        return $this->user__d_creat;
    }

   
    public function setUser__d_creat($user__d_creat){
        $this->user__d_creat = $user__d_creat;

        return $this;
    }

    public function getUser__d_off(){
        return $this->user__d_off;
    }

    
    public function setUser__d_off($user__d_off){
        $this->user__d_off = $user__d_off;

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
}
