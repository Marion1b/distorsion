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
        if (isset($get["route"]) && $get["route"] === "chat") {
            $id = $get['salon'];
            $cc->chat($id);
        } else if (isset($get["route"]) && $get["route"] === "a-propos") {
            $pc->about();
        } else if (isset($get["route"]) && $get["route"] === "connexion") {
            $auc->signIn();
        } else if (isset($get["route"]) && $get["route"] === "inscription") {
            $auc->signUp();
        } else if (!isset($get["route"])) {
            $pc->home();
        } else {
            $pc->notFound();
        }
    }
}
