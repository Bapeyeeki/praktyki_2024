<?php
include 'database.php';

// Tworzymy nowy obiekt bazy danych
$database = new Database();
// Łączymy się z bazą danych
$conn = $database->connect();

// Pobieramy notatki z bazy danych
$stmt = $database->getNotes();
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Notes Manager</h1>
    <a href="add.php">Dodaj notatkę</a>
    <br><br>
    <?php if(empty($notes)): ?>
        <p>Brak notatek.</p>
    <?php else: ?>
        <?php foreach($notes as $note): ?>
            <div>
                <h3><?=  $note['title']; ?></h3>
                <p><?= $note['content']; ?></p>
                <a href="edit.php?id=<?= $note['id']; ?>">Edytuj</a>
                <a href="delete.php?id=<?= $note['id']; ?>" onclick="return confirm('Czy na pewno chcesz usunąć tę notatkę?')">Usuń</a>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>