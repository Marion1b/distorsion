<?php

abstract class AbstractManager {
    
    protected PDO $db;
    
    public function __construct(){
        
        $host = "db.3wa.io";
    $port = "3306";
    $dbname = "benjaminhaverbeke_distorision";
    $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

    $user = "benjaminhaverbeke";
    $password = "052a871a0c9fd8d6553a4521eb1cee3b";
        
        
        $this->db = new PDO(
    $connexionString,
    $user,
    $password);
        
        
    }
    
    //$dbname = "distortion";
    
}



?>