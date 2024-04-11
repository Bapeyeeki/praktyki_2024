<?php
require_once 'db.php';

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($name, $email, $password) {
        $account_type = "uzytkownik"; // Ustawiamy domyślny typ konta na "uzytkownik"
    
        $stmt = $this->conn->prepare("INSERT INTO users_2 (name, email, password, account_type) VALUES (:name, :email, :password, :account_type)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':account_type', $account_type);
        
        return $stmt->execute();
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT user_id, email, password FROM users_2 WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
    
        if ($user && password_verify($password, $user['password'])) {
            return $user['user_id'];
        } else {
            return false;
        }
    }

    public function isEmailTaken($email) {
        $stmt = $this->conn->prepare("SELECT user_id FROM users_2 WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false;
    }
    
}