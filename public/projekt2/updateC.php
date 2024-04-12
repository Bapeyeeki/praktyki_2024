<?php
session_start();
require_once 'UserController.php';

// Utwórz połączenie z bazą danych
$db = new Database();
$conn = $db->getConnection();

$userController = new UserController($conn);

// Sprawdzenie, czy parametr 'id' został ustawiony w zapytaniu GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Nieprawidłowy identyfikator klienta.";
    exit();
}

// Pobranie identyfikatora klienta z parametru GET
$client_id = $_GET['id'];

// Pobranie danych klienta na podstawie przekazanego id
$client = $userController->getClientById($_SESSION['user_id'], $client_id);

if (!$client) {
    echo "Nie znaleziono klienta.";
    exit();
}

// Obsługa edycji danych klienta po przesłaniu formularza
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobranie nowych danych klienta z formularza
    $new_name = $_POST['new_name'];
    $new_surname = $_POST['new_surname'];
    $new_address = $_POST['new_address'];

    // Wywołanie metody kontrolera do aktualizacji danych klienta
    $userController->updateClient($_SESSION['user_id'], $client_id, $new_name, $new_surname, $new_address);

    // Przekierowanie na stronę z listą klientów lub gdziekolwiek indziej po aktualizacji
    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja danych klienta</title>
</head>
<body>
    <h2>Edytuj dane klienta</h2>
    <form action="updateC.php?id=<?php echo $client_id; ?>" method="POST">
        <!-- Pola formularza do edycji danych klienta -->
        <label for="new_name">Nowe imię:</label>
        <input type="text" id="new_name" name="new_name" value="<?= $client['name']; ?>" required><br><br>
        <label for="new_surname">Nowe nazwisko:</label>
        <input type="text" id="new_surname" name="new_surname" value="<?= $client['surname']; ?>" required><br><br>
        <label for="new_address">Nowy adres:</label>
        <input type="text" id="new_address" name="new_address" value="<?= $client['address']; ?>" required><br><br>
        <input type="submit" value="Zapisz zmiany">
    </form>
</body>
</html>