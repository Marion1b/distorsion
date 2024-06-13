<?php

abstract class AbstractManager
{

    protected PDO $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=localhost;port=3306;dbname=distorsion",
            "root",
            ""
        );
    }
}
