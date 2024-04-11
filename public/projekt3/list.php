<?php
require_once 'db.php';

$search = ''; // Inicjalizacja zmiennej dla wyszukiwania
$sort_by = 'status'; // zmienna do sortowania

// Szukanie zadań
if(isset($_GET['search'])) {
    $search = strtolower(trim($_GET['search']));
}

// Cofnięcie
if(isset($_POST['reset'])) {
    $search = '';
}

// Sortowanie
if(isset($_POST['sort'])) {
    $sort_by = $_POST['sort'];
}

try {
    // Utworzenie obiektu połączenia z bazą danych
    $database = new Database();

    if (isset($_GET['submit'])) {
        // Sprawdzenie czy pole "Opis zadania" jest puste
        if(empty($_GET['zadanie'])) {
            echo "<b>Opis zadania i status są wymagane!</b><br><br>";
        } else {
            // Utworzenie zadania
            $result = $database->createTask($_GET['zadanie'], $_GET['status']);
            if ($result) {
                echo "Records inserted successfully.<br><br>";
            } else {
                echo "Error during insertion.<br><br>";
            }
        }
    }

    if(isset($_GET['delete'])) {
        // Usunięcie zadania
        $result = $database->deleteTask($_GET['delete']);
        if($result) { 
            echo "Records deleted!<br><br>";
        } else {
            echo "Error during deletion.<br><br>";
        }
    }

    if(isset($_GET['done'])) {
        // Oznaczenie zadania jako zakończone
        $result = $database->changeStatus($_GET['done']);
        if($result) { 
            echo "Records updated!<br><br>";
        } else {
            echo "Error during updating.<br><br>";
        }
    }

    // Funkcja wyswietlania rekordow listy
    $recordsArray = $database->getRecords($search, $sort_by);

    // Przetwarzanie rekordów w tablicy
    foreach ($recordsArray as $record) {
        echo $record['id']." | ".$record['task']." |  ".$record['status']." <a href='?delete={$record['id']}'> X</a> 
        <a href='?done={$record['id']}'>Done</a><br>";
    }
} catch(PDOException $e) {
    // Obsługa błędów
    die("Connection failed: " . $e->getMessage());
}