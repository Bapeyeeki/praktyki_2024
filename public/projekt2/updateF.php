<?php
session_start();
require_once 'UserController.php';

// Utwórz połączenie z bazą danych
$db = new Database();
$conn = $db->getConnection();

$userController = new UserController($conn);

// Sprawdzenie, czy parametr 'id' został ustawiony w zapytaniu GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Nieprawidłowy identyfikator firmy.";
    exit();
}

// Pobranie identyfikatora firmy z parametru GET
$company_id = $_GET['id'];

// Pobranie danych firmy na podstawie przekazanego id
$company = $userController->getCompanyById($_SESSION['user_id'], $company_id);

if (!$company) {
    echo "Nie znaleziono firmy.";
    exit();
}

// Obsługa edycji danych firmy po przesłaniu formularza
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobranie nowych danych firmy z formularza
    $new_name = $_POST['new_name'];
    $new_address = $_POST['new_address'];

    // Wywołanie metody kontrolera do aktualizacji danych firmy
    $userController->updateCompany($_SESSION['user_id'], $company_id, $new_name, $new_address);

    // Przekierowanie na stronę z listą firm lub gdziekolwiek indziej po aktualizacji
    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja danych firmy</title>
</head>
<body>
    <h2>Edytuj dane firmy</h2>
    <form action="updateF.php?id=<?php echo $company_id; ?>" method="POST">
        <!-- Pola formularza do edycji danych firmy -->
        <label for="new_name">Nowa nazwa:</label>
        <input type="text" id="new_name" name="new_name" value="<?php echo $company['name']; ?>" required><br><br>
        <label for="new_address">Nowy adres:</label>
        <input type="text" id="new_address" name="new_address" value="<?php echo $company['address']; ?>" required><br><br>
        <input type="submit" value="Zapisz zmiany">
    </form>
</body>
</html>