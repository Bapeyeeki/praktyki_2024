<?php

function createTask($conn, string $zadanie, string $status): bool
{
    // Sprawdzanie czy pole "Opis zadania" jest puste
    if(empty($zadanie) ) {
        return false;
    } else {
        // Create prepared statement
        $sql = "INSERT INTO zadania (tasks, is_done) VALUES (:tasks, :is_done)";
        $stmt = $conn->prepare($sql);
    
        // Bind parameters 
        $stmt->bindValue(':tasks', $zadanie, PDO::PARAM_STR);
        $stmt->bindValue(':is_done', $status, PDO::PARAM_INT);
    
        // Execute 
        $stmt->execute();

        return true;
    }
}

function deleteTask($conn, string $id)
{
    try {
        $sql = "DELETE FROM zadania WHERE id=:id";
        // Create prepared statement
        $stmt = $conn->prepare($sql);

        // Bind parameters 
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Execute 
        $stmt->execute();
        return true;
    }catch (PDOException $e){
        return false; 
    }
}

function changeStatus($conn, string $done)
{
    try {
        $sql = "UPDATE zadania SET is_done = (1 - is_done) WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $done, PDO::PARAM_INT);
        $stmt->execute();
        return true; 
    } catch(PDOException $e) {
        return false; 
    }    
}

function getRecords($conn,string $search, string $sort_by) {
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

    $records = []; // Tablica na rekordy

    while ($row = $stmt->fetch()) {
        if(empty($search) || strpos($row['tasks'], $search) !== false) {
            $status = ($row['is_done'] == 0) ? 'Nie zrobione' : 'Skończone';

            // Dodajemy rekord do tablicy
            $records[] = [
                'id' => $row['id'],
                'task' => $row['tasks'],
                'status' => $status,
                'delete_link' => "list.php?delete={$row['id']}",
                'done_link' => "list.php?done={$row['id']}"
            ];
        }
    }

    return $records;
}