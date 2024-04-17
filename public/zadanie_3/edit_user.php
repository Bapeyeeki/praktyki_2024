<?php

require_once 'db.php';
require_once 'UserRepository.php';

// Sprawdzamy, czy przekazano parametr user_id w żądaniu GET
if(isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    
    // Tworzymy obiekt Database i łączymy się z bazą danych
    $db = new Database();
    
    // Tworzymy obiekt UserRepository i przekazujemy do niego obiekt Database
    $userRepo = new UserRepository($db);

    // Pobieramy dane użytkownika do edycji na podstawie user_id
    $user = $userRepo->getUserById($userId);
    
    // Sprawdzamy, czy użytkownik o podanym user_id istnieje
    if($user) {
        // Obsługa formularza edycji danych użytkownika
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Tutaj możemy odczytać dane przesłane przez formularz edycji i zaktualizować użytkownika w bazie danych
            // Na potrzeby przykładu pominiemy to

            echo "<p>User data updated successfully!</p>";
        } else {
            // Wyświetlamy formularz edycji danych użytkownika
            echo "<h2>Edit User Data</h2>";
            echo "<form method='post'>";
            echo "<label for='name'>Name:</label>";
            echo "<input type='text' id='name' name='name' value='{$user['name']}'><br>";
            echo "<label for='surname'>Surname:</label>";
            echo "<input type='text' id='surname' name='surname' value='{$user['surname']}'><br>";
            echo "<label for='address'>Address:</label>";
            echo "<input type='text' id='address' name='address' value='{$user['address']}'><br>";
            echo "<button type='submit'>Save Changes</button>";
            echo "</form>";
        }
    } else {
        echo "<p>User not found.</p>";
    }
} else {
    echo "<p>Invalid user ID.</p>";
}