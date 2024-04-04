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

    if(isset($_POST['submit'])) {
        // Sprawdzanie czy pole "Opis zadania" jest puste
        if(empty($_POST['zadanie']) ) {
            echo "<b>Opis zadania wymagany!</b><br><br>";
        } else {
            // Create prepared statement
            $sql = "INSERT INTO zadania (tasks, is_done) VALUES (:tasks, :is_done)";
            $stmt = $conn->prepare($sql);
        
            // Bind parameters 
            $stmt->bindValue(':tasks', $_POST['zadanie'], PDO::PARAM_STR);
             $stmt->bindValue(':is_done', $_POST['status'], PDO::PARAM_INT);
        
            // Execute 
             $stmt->execute();
            echo "Records inserted successfully.<br><br>";
        }
    }

    if(isset($_GET['delete'])) {
        $sql = "DELETE FROM zadania WHERE id=:id";
        // Create prepared statement
        $stmt = $conn->prepare($sql);

         // Bind parameters 
        $stmt->bindValue(':id', $_GET['delete'], PDO::PARAM_INT);

        // Execute 
        $stmt->execute();
        echo "Record deleted successfully.<br><br>";
    }

    if(isset($_GET['done'])) {
        $sql = "UPDATE zadania SET is_done= (1 - is_done) WHERE id=:id";

        // Create prepared statement
        $stmt = $conn->prepare($sql);

         // Bind parameters 
        $stmt->bindValue(':id', $_GET['done'], PDO::PARAM_INT);
      
        // Execute 
        $stmt->execute();
        echo "Task status updated successfully.<br><br>";
    }

    $sql = "SELECT * FROM zadania";

    if(!empty($search)) {
        $sql .= " WHERE tasks LIKE :search";
    }

    if($sort_by === 'status') {
        $sql .= " ORDER BY is_done ASC"; // Uporządkowanie według statusu wykonania
    } elseif ($sort_by === 'opis') {
        $sql .= " ORDER BY tasks ASC"; // Uporządkowanie według opisu zadania
    }

    // Create prepared statement
    $stmt = $conn->prepare($sql);

    if (!empty($search)) {
        // Bind parameters 
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    }

    // Execute 
    $stmt->execute();

    // Wyświetl zadania
    while ($row = $stmt->fetch()) {
        if(empty($search) || strpos($row['tasks'], $search) !== false) {
            if($row['is_done'] == 0) {
                $row['is_done'] ='Nie zrobione';
            } else {
                $row['is_done'] ='Skończone';
            }

            echo $row['id']." | ".$row['tasks']." |  ".$row['is_done']." <a href='list.php?delete=".$row['id']."'> X</a> 
            <a href='list.php?done=".$row['id']."'>Done</a><br>";
        }
    }
} catch(PDOException $e) {

    // Obsługa błędów
    die("Connection failed: " . $e->getMessage());
} finally {
    
    // Zamknięcie połączenia
    $conn = null;
}

