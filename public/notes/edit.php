<?php
include 'database.php';

// Sprawdzenie, czy zostało przesłane ID notatki do edycji
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Pobranie ID notatki do edycji
    $id = $_GET['id'];

    // Tworzenie nowego obiektu bazy danych
    $database = new Database();
    // Łączenie z bazą danych
    $conn = $database->connect();

    // Pobranie danych istniejącej notatki do edycji
    $note = $database->getNoteById($id);

    // Sprawdzenie, czy notatka istnieje
    if (!$note) {
        // Jeśli notatka nie istnieje, przekieruj na stronę główną
        header("Location: index.php");
        exit;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Jeśli formularz został przesłany metodą POST, obsługujemy edycję notatki

    // Pobranie danych z formularza
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Tworzenie nowego obiektu bazy danych
    $database = new Database();
    // Łączenie z bazą danych
    $conn = $database->connect();

    // Edycja notatki w bazie danych
    if ($database->editNote($id, $title, $content)) {
        // Jeśli edycja przebiegła pomyślnie, przekieruj na stronę główną
        header("Location: index.php");
        exit;
    } else {
        // W przypadku błędu komunikat
        echo "Wystąpił błąd podczas edycji notatki.";
    }
} else {
    // Jeśli nie zostało przesłane ID notatki, przekieruj na stronę główną
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj notatkę</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <h1>Edytuj notatkę</h1>
    <form method="post" action="">
        <!-- Pole ukryte z ID notatki -->
        <input type="hidden" name="id" value="<?= $note['id']; ?>">
        <label>Tytuł:</label><br>
        <input type="text" name="title" value="<?= $note['title']; ?>" required><br>
        <label>Treść:</label><br>
        <textarea name="content" required><?= $note['content']; ?></textarea><br>
        <input type="submit" value="Zapisz zmiany">
    </form>
</body>
</html>