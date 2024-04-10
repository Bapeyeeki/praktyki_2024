<?php
session_start();
require_once 'User.php'; // Import klasy User

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Sprawdzenie, czy żądanie jest typu POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdzenie, czy został przekazany parametr "type"
    if(isset($_POST['type'])) {
        $type = $_POST['type'];

        // Tworzenie obiektu klasy User
        $servername = "mysql";
        $db_username = "v.je";
        $db_password = "v.je";
        $db_name = "praktyki";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $user = new User($conn);

            // Dodawanie nowego klienta
            if ($type === "client" && isset($_POST['client_name']) && isset($_POST['client_surname'])) {
                $client_name = $_POST['client_name'];
                $client_surname = $_POST['client_surname'];
                $user->addClient($client_name, $client_surname);
            }

            // Dodawanie nowej firmy
            if ($type === "company" && isset($_POST['company_name'])) {
                $company_name = $_POST['company_name'];
                $user->addCompany($company_name);
            }

            // Przekierowanie na stronę główną po dodaniu wpisu
            header("Location: list.php");
            exit();
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}