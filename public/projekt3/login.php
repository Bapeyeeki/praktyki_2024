<?php
require_once 'UserController.php';
require_once 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();

    $userController = new UserController($conn);

    $username = $_POST['email'];
    $password = $_POST['password'];

    $user_id = $userController->login($username, $password);

    if ($user_id) {
        $userType = $userController->getUserType($username);
        if ($userType == 'administrator') {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: taski.php");
            exit();
        }
    } else {
        echo "Nieprawidłowa nazwa użytkownika lub hasło.";
    }
}