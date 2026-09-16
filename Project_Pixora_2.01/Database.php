<?php

class Database
{
    private $host = 'localhost';        // Database host
    private $dbname = 'pixora';         // Database name
    private $username = 'root';         // Database username
    private $password = '';             // Database password
    private $pdo;                       // PDO instance

    public function __construct()
    {
        $this->loadEnv();
    }

    /**
     * Load environment variables from .env file if it exists
     */
    private function loadEnv()
    {
        $envPaths = [
            __DIR__ . '/.env',
            dirname(__DIR__) . '/.env'
        ];

        foreach ($envPaths as $envFile) {
            if (file_exists($envFile) && is_readable($envFile)) {
                $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line === '' || str_starts_with($line, '#')) {
                        continue;
                    }
                    if (strpos($line, '=') !== false) {
                        list($key, $val) = explode('=', $line, 2);
                        $key = trim($key);
                        $val = trim($val, " \t\n\r\0\x0B\"'");
                        if (!array_key_exists($key, $_ENV)) {
                            $_ENV[$key] = $val;
                            putenv("$key=$val");
                        }
                    }
                }
                break;
            }
        }

        $this->host = getenv('DB_HOST') ?: $this->host;
        $this->dbname = getenv('DB_NAME') ?: $this->dbname;
        $this->username = getenv('DB_USER') ?: $this->username;
        $envPass = getenv('DB_PASS');
        if ($envPass !== false) {
            $this->password = $envPass;
        }
    }

    // Method to establish a connection
    public function connect()
    {
        if ($this->pdo === null) { // Check if connection already exists
            try {
                $this->pdo = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",
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
