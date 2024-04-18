<?php

// Połączenie z bazą danych MySQL
$servername = "mysql";
$username = "v.je";
$password = "v.je";
$dbname = "praktyki";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Import klasy QueryBuilder
    require_once 'QueryBuilder.php';

    // Utworzenie obiektu QueryBuilder
    $query = (new QueryBuilder())
        ->table('userss')
        ->select(['id', 'name', 'email'])
        ->where('status', '=', 'active')
        ->where('age', '>', 18) 
        ->orderBy('name', 'ASC')
        ->buildSelect();

    $statement = $conn->query($query);

    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        echo "ID: {$row['id']}, Name: {$row['name']}, Email: {$row['email']}<br>";
    }

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}