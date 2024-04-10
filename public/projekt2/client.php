<?php
session_start();
require_once 'UserController.php';

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userController = new UserController();

// Upewnienie się, że parametr 'id' został przekazany i jest liczbą
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Nieprawidłowy parametr id.";
    exit();
}

$clientId = $_GET['id'];

// Pobranie szczegółowych informacji o kliencie
$client = $userController->getClientDetails($_SESSION['user_id'], $clientId);

// Sprawdzenie, czy klient istnieje lub należy do zalogowanego użytkownika
if ($client === null) {
    echo "Nie znaleziono klienta.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły klienta</title>
</head>
<body>
    <h1>Szczegóły klienta</h1>
    <ul>
        <li><strong>Imię:</strong> <?php echo $client['name']; ?></li>
        <li><strong>Nazwisko:</strong> <?php echo $client['surname']; ?></li>
        <!-- Dodaj więcej informacji o kliencie, jeśli jest to konieczne -->
    </ul>

    <!-- Przycisk "Edytuj" -->
    <form action="edit_client.php" method="POST">
        <input type="hidden" name="client_id" value="<?php echo $clientId; ?>">
        <input type="submit" value="Edytuj">
    </form>

    <!-- Przycisk "Usuń" -->
    <form action="delete_client.php" method="POST">
        <input type="hidden" name="client_id" value="<?php echo $clientId; ?>">
        <input type="submit" value="Usuń">
    </form>

    <!-- Przycisk "Wyznacz trasę" -->
    <form action="wyznacz_trase.php" method="POST">
        <input type="hidden" name="client_id" value="<?php echo $clientId; ?>">
        <input type="submit" value="Wyznacz trasę">
    </form>
</body>
</html>