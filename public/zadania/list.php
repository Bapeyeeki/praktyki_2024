<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
</head>
<body>
    <form action="" method="post">
        Opis zadania: <input type="text" name="zadanie" id="zadanie"><br><br>
        Status zadania: <input type="number" min="0" max="1" name="status" id="is_done"><br><br>
        <input type="submit" value="zapisz" name="submit">
        <input type="reset" value="reset"><br>
    </form>

    <br>

    <?php
        $servername = "mysql";
        $username = "v.je";
        $password = "v.je";
        $db = "praktyki";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=praktyki", $username, $password);
            // Ustawienie trybu wyjątków PDO na ERRMODE_EXCEPTION
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if(isset($_POST['submit'])) {
                // Sprawdź czy pole "Opis zadania" nie jest puste
                if(empty($_POST['zadanie'] && $_POST['status'])) {
                    echo "<b>Oba pola sa wymagane!</b><br><br>";
                } else {
                    // Create prepared statement
                    $sql = "INSERT INTO zadania (tasks, is_done) VALUES (:tasks, :is_done)";
                    $stmt = $conn->prepare($sql);
                
                    // Bind parameters to statement
                    $stmt->bindValue(':tasks', $_POST['zadanie'], PDO::PARAM_STR);
                    $stmt->bindValue(':is_done', $_POST['status'], PDO::PARAM_INT);
                
                    // Execute the prepared statement
                    $stmt->execute();
                    echo "Records inserted successfully.<br>";
                }
            }

            if(isset($_GET['delete'])) {
                $sql = "DELETE FROM zadania WHERE id=:id";
                $stmt = $conn->prepare($sql);

                $stmt->bindValue(':id', $_GET['delete'], PDO::PARAM_INT);

                $stmt->execute();
                echo "Record deleted successfully.<br>";
            }

            if(isset($_GET['done'])) {

                $sql = "UPDATE zadania SET is_done= (1 - is_done) WHERE id=:id";

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $_GET['done'], PDO::PARAM_INT);
              
                $stmt->execute();
                echo "Task status updated successfully.<br>";
              
            }

            $stmt = $conn->query("SELECT * FROM zadania");
                
            while ($row = $stmt->fetch()) {

                if($row['is_done'] == 0) {
                    $row['is_done'] ='Nie zrobione';
                }else {
                    $row['is_done'] ='Skonczone';
                }

                echo $row['id']." | ".$row['tasks']." |  ".$row['is_done']." <a href='list.php?delete=".$row['id']."'> X</a> 
                <a href='list.php?done=".$row['id']."'>Done</a><br>";

            }
        } catch(PDOException $e) {
            // Obsługa błędów
            die("Connection failed: " . $e->getMessage());
        } finally {
            // Zamknięcie połączenia
            $conn = null;
        }
    ?>
</body>
</html>