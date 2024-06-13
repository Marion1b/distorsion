<?php

class AuthController{
    public function __construct()
    {
        
    }

    public function signIn():void{
        $route="connexion";
        require "templates/layout.phtml";
    }

    public function signUp():void{
        $route="inscription";
        require "templates/layout.phtml";
    }
}



?>