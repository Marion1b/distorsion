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

    public function checkMessage($id): void
    {
        if (isset($_SESSION["email"]) && isset($_POST["message"])) {
            $mm = new MessageManager;
            $sm = new SalonManager;
            $um = new UserManager;
            $currentDateTime = new DateTime(date('Y-m-d H:i:s'));


            var_dump($_SESSION['email']);
            $user =  $um->findByEmail($_SESSION["email"]);
            $salon = $sm->findOne($id);
            // private string $content, private User $author, private Salon $salon, private DateTime $createdAt = new DateTime())
            $message = new Message($_POST["message"], $user, $salon, $currentDateTime);
            $mm->createMessage($message);
            header("Location: index.php?route=chat&salon=" . $id);
        } else {
            $error = "Veuillez rejoindre la communauté des distordu-e-s pour pouvoir poster un message.";
            header("Location: index.php?route=error&error=" . $error);
        }
    }
}
