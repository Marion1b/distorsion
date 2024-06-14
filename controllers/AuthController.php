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
        $userFound = $instance->findByEmail($email);
        //if user not found in db give error
        if (!$userFound) {
            $route = "error";
            $error = "Nous n'avons pas encore enregistré cette entité email dans notre espace cosmique, veuillez-vous inscrire";
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
                $error = "L'entité mot de passe ne correspond pas, veuillez entrer en introspection pour le révéler à vous et réessayer";
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
        $user = new User($name, $email, $hash, $role);
        $instance = new UserManager;
        //find user 
        $userFound = $instance->findByEmail($email);
        //if email allready used give error
        if ($userFound) {
            $route = "error";
            $error = "Cet entité Email est déjà dans notre espace cosmique, veuillez entrer en introspection pour le révéler à vous ou réessayez avec avec un autre email";
            require 'templates/layout.phtml';
            //if email not found create new user
        } else {
            $instance->createUser($user);
            $_SESSION['email'] = $email;
            //redirect to home
            $route = "home";
            require 'templates/layout.phtml';
        }
    }
    public function disconnect(): void
    {
        session_destroy();
        $route = "deconnexion";
        header('Location: index.php');
    }
    public function error($error): void
    {
        $route = "error";
        require 'templates/layout.phtml';
    }
}
