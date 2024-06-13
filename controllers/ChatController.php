<?php

class ChatController
{
    public function __construct()
    {
    }

    /**A delete */
    public function chatTest():void{
        $route = "chat";
        require "templates/layout.phtml";
    }

    public function chat($id): void
    {
        //init manager
        $instance = new SalonManager;
        //get all posts from selected category
        $messages = $instance->findAllFromSalon($_GET['salon']);
        $route = "chat";
        require "templates/layout.phtml";
    }
}
