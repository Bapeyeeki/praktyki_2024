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