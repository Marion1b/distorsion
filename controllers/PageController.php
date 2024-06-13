<?php

class PageController{
    public function __construct(){

    }

    public function home():void{
        $route = "home";
        require "templates/layout.phtml";
    }

    public function about():void{
        $route="a-propos";
        require "templates/layout.phtml";
    }

    public function notFound():void{
        $route = "404";
        require "templates/layout.phtml";
    }
    
    public function userProfil():void{
        $route="user-profil";
        
        $um = new UserManager();
        $mm = new MessageManager();
        
        $user = $um->findByEmail($_SESSION['email']);
        $userMessages = $mm->findByUser($user->getId());
        
        
        
        require "templates/layout.phtml";
    }
    
}

?>