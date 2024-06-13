<?php

class AuthController
{
    public function __construct()
    {
    }

    public function signIn(): void
    {
        $route = "connexion";
        require "templates/layout.phtml";
    }

    public function checkSignIn(): void
    {
        //get form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        //init manager
        $instance = new UserManager;
        //find user 
        $userFound = $instance->findOne($email);
        //if user not found in db give error
        if (!$userFound) {
            $route = "error";
            $error = "Nous n'avons pas cet email en utilisateur, veuillez-vous inscrire";
            require 'templates/layout.phtml';
            //if user found check password
        } else {
            $hashFound = $userFound->getPassword();
            $isPasswordCorrect = password_verify($password, $hashFound);
            if ($isPasswordCorrect) {
                //connect session
                $_SESSION['email'] = $email;
                //redirect to home
                $route = "home";
                require 'templates/layout.phtml';
            } else {
                $route = "error";
                $error = "Le mot de passe est erroné, veuillez réessayer";
                require 'templates/layout.phtml';
            }
        }
    }

    public function signUp(): void
    {
        $route = "inscription";
        require "templates/layout.phtml";
    }
    public function checkSignUp(): void
    {
        //get form data
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $role = 'USER';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        //init manager
        $user = new User($_POST['username'], $email, $hash, $_POST['role'], $_POST['createdAt']);
        $instance = new UserManager;
        //find user 
        $userFound = $instance->findOne($email);
        //if email allready used give error
        if ($userFound) {
            $route = "error";
            $error = "Email déjà utilisé, veuillez vous connecter ou choisir un autre email.";
            require 'templates/layout.phtml';
            //if email not found create new user
        } else {
            $instance->create($user);
            $_SESSION['email'] = $email;
            //redirect to home
            $route = "home";
            require 'templates/layout.phtml';
        }
    }
}
