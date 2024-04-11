<?php
require_once 'UserController.php';
require_once 'db.php'; // Poprawiono nazwę pliku

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();

    $userController = new UserController($conn);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    $min_password_length = 8;
    if (strlen($password) < $min_password_length) {
        echo "Hasło musi mieć co najmniej $min_password_length znaków.";
        exit();
    }

    // Silne hasło
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password)) {
        echo "Hasło musi zawierać co najmniej jedną małą literę, jedną wielką literę, jedną cyfrę i jeden znak specjalny.";
        exit();
    }

    // Walidacja unikalności adresu e-mail
    if ($userController->userModel->isEmailTaken($email)) {
        echo "Adres e-mail jest już zajęty.";
        exit();
    }

    if ($password !== $password_repeat) {
        echo "Hasła nie są identyczne.";
    } else {
        $message = $userController->registerUser($name, $email, $password);

        if ($message === "Rejestracja udana. Możesz się zalogować.") {
            header("Location: index.php");
            exit();
        } else {
            echo $message;
        }
    }
}