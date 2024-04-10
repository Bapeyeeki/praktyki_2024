<?php
require_once 'database.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function register($username, $password) {
        $stmt = $this->conn->prepare("INSERT INTO users (login, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

    public function isUsernameTaken($username) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE login = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false;
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT id, login, password FROM users WHERE login = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        } else {
            return false;
        }
    }

    public function addClient($client_name, $client_surname) {
        
        $stmt = $this->conn->prepare("INSERT INTO clients (name, surname) VALUES (:client_name, :client_surname)");
        
        $stmt->bindParam(':client_name', $client_name);
        $stmt->bindParam(':client_surname', $client_surname);
        
        return $stmt->execute();
    }


}