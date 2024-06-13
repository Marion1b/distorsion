<?php

class ChatController
{
    public function __construct()
    {
    }

    public function chat($id): void
    {
        //init manager
        $instance = new MessageManager;
        //get all posts from selected category
        $messages = $instance->findBySalon($id);
        $route = "chat";
        require "templates/layout.phtml";
    }
}
