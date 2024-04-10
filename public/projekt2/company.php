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
    echo "Nieprawidłowy identyfikator firmy.";
    exit();
}

// Pobranie identyfikatora firmy z parametru GET
$company_id = $_GET['id'];

$userModel = new User();

// Sprawdzenie, czy firma należy do aktualnie zalogowanego użytkownika
$company = $userModel->getCompanyById($_SESSION['user_id'], $company_id);
if (!$company) {
    echo "Nie masz uprawnień do wyświetlenia tej firmy.";
    exit();
}

// Obsługa formularza edycji danych firmy
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        // Przekierowanie do formularza edycji danych firmy
        header("Location: updateF.php?id=$company_id");
        exit();
    } elseif (isset($_POST['delete'])) {
        if ($userModel->deleteCompany($_SESSION['user_id'], $company_id)) {
            // Pomyślnie usunięto firmę, przekierowanie na listę firm lub inną stronę
            header("Location: list.php");
            exit();
        } else {
            echo "Wystąpił błąd podczas usuwania firmy.";
            exit();
        }
    } elseif (isset($_POST['calculate_route'])) {
        // Obsługa wyznaczania trasy
        // Kod wyznaczania trasy
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły firmy</title>
</head>
<body>
    <h1>Szczegóły firmy</h1>
    <p>Nazwa: <?php echo $company['name']; ?></p>
    <p>Adres: <?php echo $company['address']; ?></p>

    <!-- Formularz edycji danych firmy -->
    <h2>Edycja danych firmy</h2>
    <form action="company.php?id=<?php echo $company_id; ?>" method="POST">
        <input type="submit" name="edit" value="Edytuj dane">
    </form>

    <!-- Formularz usunięcia firmy -->
    <h2>Usuwanie firmy</h2>
    <form action="company.php?id=<?php echo $company_id; ?>" method="POST">
        <input type="submit" name="delete" value="Usuń firmę">
    </form>

    <!-- Formularz wyznaczania trasy -->
    <h2>Wyznacz trasę</h2>
    <form action="company.php?id=<?php echo $company_id; ?>" method="POST">
        <input type="submit" name="calculate_route" value="Wyznacz trasę">
    </form>
</body>
</html>