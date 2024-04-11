<?php
require_once 'UserController.php';
//require_once 'Database.php'; // Poprawiono nazwę pliku

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();

    $userController = new UserController($conn);

    $username = $_POST['username'];
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

    // Walidacja unikalności nazwy użytkownika
    if ($userController->isUsernameTaken($username)) {
        echo "Nazwa użytkownika jest już zajęta.";
        exit();
    }

    if ($password !== $password_repeat) {
        echo "Hasła nie są identyczne.";
    } else {
        $message = $userController->registerUser($username, $password, $conn); // Przekazano połączenie z bazą danych

        if ($message === "Rejestracja udana. Możesz się zalogować.") {
            header("Location: login.php");
            exit();
        } else {
            echo $message;
        }
    }
}