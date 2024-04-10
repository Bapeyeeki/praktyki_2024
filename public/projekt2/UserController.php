<?php
require_once 'User.php';

class UserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new User($conn);
    }

    public function registerUser($username, $password) {
        if ($this->userModel->isUsernameTaken($username)) {
            return "Użytkownik o tej nazwie już istnieje.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            if ($this->userModel->register($username, $password_hash)) {
                return "Rejestracja udana. Możesz się zalogować.";
            } else {
                return "Błąd podczas rejestracji.";
            }
        }
    }
}