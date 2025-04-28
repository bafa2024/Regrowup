<?php

// Database connection details
class DbConnection {
    private $host = 'localhost';
    private $dbName = 'u946493694_autowork';
    private $dbUser = 'u946493694_atu';
    private $dbPassword = '^fD7HMH/]9c';
    public $pdo;

    public function __construct() {
        $this->connect();
    }

    // Database connection function using PDO
    private function connect() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbName";
            $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>
