<?php

abstract class AbstractManager
{

    protected PDO $db;

    
    public function __construct(){
        
        $host = "db.3wa.io";
    $port = "3306";
    $dbname = "benjaminhaverbeke_distorision";
    $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";


}
