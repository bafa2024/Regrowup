<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $database = 'workhouse';

    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createTable($tableName, $columns) {
        $sql = "CREATE TABLE $tableName ($columns)";
        if ($this->conn->query($sql) === TRUE) {
            echo "Table $tableName created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function deleteTable($tableName) {
        $sql = "DROP TABLE IF EXISTS $tableName";
        if ($this->conn->query($sql) === TRUE) {
            echo "Table $tableName deleted successfully";
        } else {
            echo "Error deleting table: " . $this->conn->error;
        }
    }


    public function query($sql) {
        return $this->conn->query($sql);
    }

    // Other database methods
}
?>
