<?php

class ChatController{
    public function __construct()
    {
        
    }

    public function chat():void{
        $route="chat";
        require "templates/layout.phtml";
    }
}

?>