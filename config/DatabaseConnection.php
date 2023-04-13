<?php

class DatabaseConnection
{
    private $host = 'localhost';
    private $dbname = 'cleanblog';
    private $user = 'root';
    private $password = '';

    public function databaseConfig()
    {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $e) {
            echo 'Connection error: '.$e->getMessage();
        }
    }
}
