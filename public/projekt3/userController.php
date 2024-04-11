<?php

require_once 'User.php'; // Załóżmy, że masz plik User.php zdefiniowany odpowiednio

class UserController {
    public $userModel;

    public function __construct($conn) {
        $this->userModel = new User($conn);
    }

    public function registerUser($name, $email, $password) {
        if ($this->userModel->isEmailTaken($email)) {
            return "Adres e-mail jest już zajęty.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            if ($this->userModel->register($name, $email, $password_hash)) {
                return "Rejestracja udana. Możesz się zalogować.";
            } else {
                return "Błąd podczas rejestracji.";
            }
        }
    }

    public function loginUser($email, $password) {
        // Sprawdzamy poprawność danych logowania
        return $this->userModel->login($email, $password);
    }

    // Metoda do sprawdzania typu konta użytkownika
    public function getUserType($email) {
        $stmt = $this->conn->prepare("SELECT account_type FROM users_2 WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['account_type'];
    }
} 