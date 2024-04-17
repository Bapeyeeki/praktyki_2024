<?php

require_once 'db.php';
require_once 'UserRepository.php';

// Sprawdzamy, czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdzamy, czy pole 'surname' zostało wypełnione
    if (!empty($_POST['surname'])) {
        // Tworzymy obiekt Database i łączymy się z bazą danych
        $db = new Database();
        
        // Tworzymy obiekt UserRepository i przekazujemy do niego obiekt Database
        $userRepo = new UserRepository($db);

        // Przykładowe użycie UserRepository:
        $surname = $_POST['surname'];
        $users = $userRepo->findUsersBySurname($surname);
        
        // Wyświetlamy formularz wyników wyszukiwania
        if (!empty($users)) {
            echo "<h2>Users found with surname '$surname':</h2>";
            echo "<ul>";
            foreach ($users as $user) {
                echo "<li>{$user['user_id']}: {$user['name']} {$user['surname']}, {$user['address']} 
                      <a href='edit_user.php?user_id={$user['user_id']}'>Edit</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No users found with surname '$surname'.</p>";
        }
    } else {
        echo "<p>Please enter a surname.</p>";
    }
} else {
    // Jeśli żądanie nie jest POST, przekieruj użytkownika na stronę główną
    header("Location: index.php");
    exit();
}