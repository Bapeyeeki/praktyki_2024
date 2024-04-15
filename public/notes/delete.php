<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Pobieranie ID notatki do usunięcia
    $id = $_GET['id'];

    // Tworzenie nowego obiektu bazy danych
    $database = new Database();
    // Łączenie z bazą danych
    $conn = $database->connect();

    // Usuwanie notatki z bazy danych
    if ($database->deleteNote($id)) {
        // Przekierowanie do strony głównej po usunięciu notatki
        header("Location: index.php");
        exit;
    } else {
        // W przypadku błędu komunikat
        echo "Wystąpił błąd podczas usuwania notatki.";
    }
} else {
    // Jeśli nie przekazano ID notatki do usunięcia, przekieruj na stronę główną
    header("Location: index.php");
    exit;
}