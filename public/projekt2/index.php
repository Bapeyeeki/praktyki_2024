<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Startowy</title>
</head>
<body>
    <h2>Rejestracja</h2>
    <form action="register.php" method="POST">
        <label for="username">Nazwa użytkownika:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Hasło:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="password_repeat">Powtórz hasło:</label><br>
        <input type="password" id="password_repeat" name="password_repeat" required><br><br>

        <input type="submit" value="Zarejestruj się">
    </form>

    <h2>Logowanie</h2>
        <form action="login.php" method="POST">
            <label for="username">Nazwa użytkownika:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Hasło:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Zaloguj się">
        </form>

    
</body>
</html>