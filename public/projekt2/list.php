<?php
session_start();
require_once 'UserController.php';


// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Database();
$conn = $db->getConnection();

$userController = new UserController($conn); // Przekazanie połączenia z bazą danych do konstruktora

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obsługa dodawania klienta lub firmy
    if (isset($_POST['type'])) {
        $type = $_POST['type'];

        if ($type === "client" && isset($_POST['client_name']) && isset($_POST['client_surname'])) {
            $client_name = $_POST['client_name'];
            $client_surname = $_POST['client_surname'];
            $message = $userController->addClient($client_name, $client_surname);
            echo $message;
        }

        if ($type === "company" && isset($_POST['company_name'])) {
            $company_name = $_POST['company_name'];
            $message = $userController->addCompany($company_name);
            echo $message;
        }
    }
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