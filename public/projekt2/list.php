<?php
session_start();
require_once 'User.php'; // Import klasy User

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Połączenie z bazą danych
$servername = "mysql";
$db_username = "v.je";
$db_password = "v.je";
$db_name = "praktyki";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userModel = new User($conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obsługa dodawania klienta lub firmy
        if (isset($_POST['type'])) {
            $type = $_POST['type'];

            if ($type === "client" && isset($_POST['client_name']) && isset($_POST['client_surname'])) {
                $client_name = $_POST['client_name'];
                $client_surname = $_POST['client_surname'];
                $userModel->addClient($client_name, $client_surname);
            }

            if ($type === "company" && isset($_POST['company_name'])) {
                $company_name = $_POST['company_name'];
                $userModel->addCompany($company_name);
            }
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
</head>
<body>
    <!-- Formularz dodawania klienta -->
    <h2>Dodaj nowego klienta</h2>
    <form action="list.php" method="POST">
        <input type="hidden" name="type" value="client">
        <label for="client_name">Imię:</label>
        <input type="text" id="client_name" name="client_name" required><br><br>
        <label for="client_surname">Nazwisko:</label>
        <input type="text" id="client_surname" name="client_surname" required><br><br>
        <input type="submit" value="Dodaj klienta">
    </form>

    <!-- Formularz dodawania firmy -->
    <h2>Dodaj nową firmę</h2>
    <form action="list.php" method="POST">
        <input type="hidden" name="type" value="company">
        <label for="company_name">Nazwa:</label>
        <input type="text" id="company_name" name="company_name" required><br><br>
        <input type="submit" value="Dodaj firmę">
    </form>
</body>
</html>