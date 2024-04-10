<?php
session_start();

require_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Połączenie z bazą danych
    $servername = "mysql";
    $db_username = "v.je";
    $db_password = "v.je";
    $db_name = "praktyki";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $userModel = new User($conn);

        // Pobranie danych z formularza logowania
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Logowanie użytkownika
        $user_id = $userModel->login($username, $password);
        if ($user_id) {
            // Zalogowanie użytkownika
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            // Przekierowanie na stronę główną po zalogowaniu
            header("Location: list.php");
            exit();
        } else {
            $login_error = "Nieprawidłowa nazwa użytkownika lub hasło.";
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
    <h2>Logowanie</h2>
    <?php if (isset($login_error)): ?>
        <p style="color: red;"><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Zaloguj">
    </form>
</body>
</html>