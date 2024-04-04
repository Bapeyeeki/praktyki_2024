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

