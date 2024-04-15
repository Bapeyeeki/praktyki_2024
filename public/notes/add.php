<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobieranie danych z formularza
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Tworzenie nowego obiektu bazy danych
    $database = new Database();
    // Łączenie z bazą danych
    $conn = $database->connect();

    // Dodawanie notatki do bazy danych
    if ($database->addNote($title, $content)) {
        // Przekierowanie do strony głównej po dodaniu notatki
        header("Location: index.php");
        exit;
    } else {
        // W przypadku błędu wyświetlamy komunikat
        echo "Wystąpił błąd podczas dodawania notatki.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj notatkę</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>
    <h1>Dodaj notatkę</h1>
    <form method="post" action="">
        <label>Tytuł:</label><br>
        <input type="text" name="title" required><br>
        <label>Treść:</label><br>
        <textarea name="content" required></textarea><br>
        <input type="submit" value="Dodaj">
    </form>
</body>
</html>