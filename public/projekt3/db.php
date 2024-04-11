<?php
class Database {
    private $servername = "mysql";
    private $username = "v.je";
    private $password = "v.je";
    private $dbname = "praktyki";
    private $conn;

    // Metoda do uzyskiwania połączenia z bazą danych
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}