<?php include 'functions.php'; ?>  
<?php
$servername = "mysql";
$username = "v.je";
$password = "v.je";
$db = "praktyki";
$search = ''; // Inicjalizacja zmiennej dla wyszukiwania
$sort_by = 'status'; // zmienna do sortowania

//szukanie taskow
if(isset($_POST['search'])) {
    $search = $_POST['search'];
}

//cofniecie
if(isset($_POST['reset'])) {
    $search = '';
}


//sortowanie
if(isset($_POST['sort'])) {
    $sort_by = $_POST['sort'];
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=praktyki", $username, $password);
    // Ustawienie trybu wyjątków PDO na ERRMODE_EXCEPTION
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $databse = new Database($conn);

    if (isset($_POST['submit'])) {
        // Sprawdzanie czy pole "Opis zadania" jest puste
        $result = $databse->createTask($_POST['zadanie'], $_POST['status']);

        if ($result) {
            echo "Records inserted successfully.<br><br>";
        } else {
            echo "<b>Opis zadania wymagany!</b><br><br>";
        }
    }

    if(isset($_GET['delete'])) {
        $result = $databse->deleteTask($_GET['delete']);

        if($result) { 
            echo "Records deleted!<br><br>";
        }else {
            echo "Error";
        }
    }

    if(isset($_GET['done'])) {
       $result = $databse->changeStatus($_GET['done']);

        if($result) { 
            echo "Records updated!<br><br>";
        } else {
            echo "Error";
        }
    }

    //Funkcja wyswietlania rekordow listy
    $recordsArray = $databse->getRecords($search,$sort_by);

    // Przetwarzanie rekordów w tablicy
    foreach ($recordsArray as $record) {
        echo $record['id']." | ".$record['task']." |  ".$record['status']." <a href='{$record['delete_link']}'> X</a> 
        <a href='{$record['done_link']}'>Done</a><br>";
    }
} catch(PDOException $e) {

    // Obsługa błędów
    die("Connection failed: " . $e->getMessage());
} finally {
    
    // Zamknięcie połączenia
    $conn = null;
}

