<?php
session_start();

require_once 'User.php'; // Import klasy User

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    // Połączenie z bazą danych
    $servername = "mysql";
    $db_username = "v.je";
    $db_password = "v.je";
    $db_name = "praktyki";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $user = new User($conn);

        if ($password !== $password_repeat) {
            echo "Hasła nie są identyczne.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $message = $user->register($username, $password_hash);
            echo $message;

            // Przekierowanie na stronę główną po udanej rejestracji
            if ($message === "Rejestracja udana. Możesz się zalogować.") {
                header("Location: index.php");
                exit();
            }
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}