<?php
session_start();
require_once 'User.php';

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Sprawdzenie, czy parametr 'id' został ustawiony w zapytaniu GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Nieprawidłowy identyfikator klienta.";
    exit();
}

// Pobranie identyfikatora klienta z parametru GET
$client_id = $_GET['id'];

$userModel = new User();

// Sprawdzenie, czy klient należy do aktualnie zalogowanego użytkownika
$client = $userModel->getClientById($_SESSION['user_id'], $client_id);
if (!$client) {
    echo "Nie masz uprawnień do wyświetlenia tego klienta.";
    exit();
}

// Obsługa edycji danych klienta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        header("Location: updateC.php?id=" . $client_id);
        exit();
    } elseif (isset($_POST['delete'])) {
        if ($userModel->deleteClient($_SESSION['user_id'], $client_id)) {
            // Pomyślnie usunięto klienta, przekierowanie na listę klientów lub inną stronę
            header("Location: list.php");
            exit();
        } else {
            echo "Wystąpił błąd podczas usuwania klienta.";
            exit();
        }
    } elseif (isset($_POST['calculate_route'])) {
        // Obsługa wyznaczania trasy
        // ...
    }
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
    <p>Imię: <?php echo $client['name']; ?></p>
    <p>Nazwisko: <?php echo $client['surname']; ?></p>
    <p>Adres: <?php echo $client['address']; ?></p>

    <!-- Formularz edycji danych klienta -->
    <h2>Edycja danych klienta</h2>
    <form action="client.php?id=<?php echo $client_id; ?>" method="POST">
        <!-- Pola formularza do edycji danych klienta -->
        <input type="submit" name="edit" value="Edytuj dane">
    </form>

    <!-- Formularz usunięcia klienta -->
    <h2>Usuwanie klienta</h2>
    <form action="client.php?id=<?php echo $client_id; ?>" method="POST">
        <input type="submit" name="delete" value="Usuń klienta">
    </form>

    <!-- Formularz wyznaczania trasy -->
    <h2>Wyznacz trasę</h2>
    <form action="client.php?id=<?php echo $client_id; ?>" method="POST">
        <input type="submit" name="calculate_route" value="Wyznacz trasę">
    </form>
</body>
</html>