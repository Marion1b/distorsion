<?php

class Router
{
    public function __construct()
    {
    }

    public function handleRequest(array $get): void
    {
        $pc = new PageController();
        $cc = new ChatController();
        $auc = new AuthController();
        $am = new AdminController();
        
        if (isset($get["route"]) && $get["route"] === "chat") {
            if (isset($get['salon'])) {
                $cc->salon($get['salon']);
            } else {
                $cc->chat();
            }
        } else if (isset($get["route"]) && $get["route"] === "a-propos") {
            $pc->about();
        } else if (isset($get["route"]) && $get["route"] === "check-message") {
            if (isset($get['salon'])) {
                $cc->checkMessage($get['salon']);
            } else {
                $cc->chat();
            }
        } else if (isset($get["route"]) && $get["route"] === "connexion") {
            $auc->signIn();
        } elseif (isset($get["route"]) && $get["route"] === "check-signup") {

            $auc->checkSignUp();
        } elseif (isset($get["route"]) && $get["route"] === "check-signin") {

            $auc->checkSignIn();
        } else if (isset($get["route"]) && $get["route"] === "inscription") {
            $auc->signUp();
        } elseif (isset($get["route"]) && $get["route"] === "user-profil") {

            $pc->userProfil();
        } elseif (isset($get["route"]) && $get["route"] === "deconnexion") {

            $auc->disconnect();

        
        }
        elseif(isset($get["route"]) && $get["route"] === "adminpage" ){
            
            
            
            $pc->adminPage();
        
        }
        elseif(isset($get["route"]) && $get["route"] === "create-user" ){
            
            
            
            $am->createUser();
        
        }
        elseif(isset($get["route"]) && $get["route"] === "delete-user" ){
            
            
            
            $am->deleteUser($get["user"]);
        
        }
        
        

        elseif (isset($get["route"]) && $get["route"] === "error") {
            if (isset($get['error'])) {
                $error = $get['error'];
            } else {
                $error = "Erreur mystérieuse";
            }
            $auc->error($error);
        } else if (!isset($get["route"])) {

            $pc->home();
        } else {
            $pc->notFound();
        }
    }
}
