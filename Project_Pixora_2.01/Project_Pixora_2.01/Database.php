<?php

class Database
{
    private $host = 'localhost';        // Database host
    private $dbname = 'pixora';         // Database name
    private $username = 'root';         // Database username
    private $password = '';             // Database password
    private $pdo;                       // PDO instance

    // Method to establish a connection
    public function connect()
    {
        if ($this->pdo === null) { // Check if connection already exists
            try {
                $this->pdo = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
                    $this->username,
                    $this->password
                );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->pdo; // Return the PDO instance
    }
}
