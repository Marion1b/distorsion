<?php

class ChatController
{
    public function __construct()
    {
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
