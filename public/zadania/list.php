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

if(isset($_POST['sort'])) {
    $sort_by = $_POST['sort'];
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=praktyki", $username, $password);
    // Ustawienie trybu wyjątków PDO na ERRMODE_EXCEPTION
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['submit'])) {
        // Sprawdź czy pole "Opis zadania" nie jest puste
        if(empty($_POST['zadanie']) ) {
            echo "<b>Opis zadania wymagany!</b><br><br>";
        } else {
            // Create prepared statement
            $sql = "INSERT INTO zadania (tasks, is_done) VALUES (:tasks, :is_done)";
            $stmt = $conn->prepare($sql);
        
            // Bind parameters to statement
            $stmt->bindValue(':tasks', $_POST['zadanie'], PDO::PARAM_STR);
             $stmt->bindValue(':is_done', $_POST['status'], PDO::PARAM_INT);
        
            // Execute the prepared statement
             $stmt->execute();
            echo "Records inserted successfully.<br><br>";
        }
    }

    if(isset($_GET['delete'])) {
        $sql = "DELETE FROM zadania WHERE id=:id";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $_GET['delete'], PDO::PARAM_INT);

        $stmt->execute();
        echo "Record deleted successfully.<br><br>";
    }

    if(isset($_GET['done'])) {
        $sql = "UPDATE zadania SET is_done= (1 - is_done) WHERE id=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $_GET['done'], PDO::PARAM_INT);
      
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

    $stmt = $conn->prepare($sql);

    if (!empty($search)) {
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    }

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
