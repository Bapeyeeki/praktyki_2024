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

    public function login($email, $password) {
        // Pobierz użytkownika na podstawie adresu e-mail
        $user = $this->userModel->getUserByEmail($email);

        // Sprawdź czy użytkownik istnieje i czy hasło jest poprawne
        if ($user && password_verify($password, $user['password'])) {
            // Zwróć identyfikator użytkownika
            return $user['user_id'];
        } else {
            // W przypadku niepoprawnych danych logowania, zwróć false
            return false;
        }
    }

    public function getUserType($username) {
        return $this->userModel->getUserType($username);
    }

    public function getAllUsers() {
        return $this->userModel->getAllUsers();
    }
} 