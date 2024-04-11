<?php
require_once 'UserController.php';
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();

    $userController = new UserController($conn);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_id = $userController->login($email, $password);

    if ($user_id) {
        // Pobranie typu konta użytkownika
        $user_type = $userController->getUserType($email);

        // Przekierowanie użytkownika na odpowiednią stronę w zależności od typu konta
        if ($user_type === 'admin') {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: welcome.php");
            exit();
        }
    } else {
        // Nieprawidłowe dane logowania
        echo "Nieprawidłowy adres e-mail lub hasło.";
    }
}