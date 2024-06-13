<?php

abstract class AbstractManager {
    
    protected PDO $db;
    
    public function __construct(){
        
        $host = "localhost";
    $port = "3306";
    $dbname = "distorsion";
    $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

    $user = "root";
    $password = "";
        
        
        $this->db = new PDO(
    $connexionString,
    $user,
    $password);
        
        
    }
    
    
    
}



?>