<?php

class ChatController
{
    public function __construct()
    {
    }
    public function chat(): void
    {
        //init manager
        $cm = new CategoryManager;
        //get all posts from selected category
        $categories = $cm->findAll();
        $route = "chat";
        require "templates/layout.phtml";
    }
    public function salon($id): void
    {
        //init manager
        $mm = new MessageManager;
        $cm = new CategoryManager;
        $sm = new SalonManager;
        //get all posts from selected category
        $messages = $mm->findBySalon($id);
        $categories = $cm->findAll();
        $route = "salon";
        require "templates/layout.phtml";
    }
}
