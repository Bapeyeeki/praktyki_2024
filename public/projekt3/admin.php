<?php
require_once 'UserController.php';
require_once 'db.php'; // Załóżmy, że zawiera plik db.php zdefiniowany w projekcie

$db = new Database(); // Tworzymy połączenie z bazą danych
$conn = $db->getConnection(); // Pobieramy połączenie

$userController = new UserController($conn); // Tworzymy instancję UserController i przekazujemy połączenie z bazą danych

// Pobranie listy użytkowników
$users = $userController->getAllUsers();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administracyjny</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
    <h2>Admin Panel</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa użytkownika</th>
                <th>Email</th>
                <th>Typ konta</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['account_type']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>