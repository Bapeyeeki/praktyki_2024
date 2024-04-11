<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Logowania i Rejestracji</title>
    <link rel="stylesheet" href="style.css"> <!-- Plik CSS do stylizacji formularzy -->
</head>
<body>

    <div class="container">
        <h2>Rejestracja</h2>
        <form action="register.php" method="POST">
            <label for="register_name">Imię i nazwisko:</label>
            <input type="text" id="name" name="name" >
            <label for="register_email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="register_password">Hasło:</label>
            <input type="password" id="password" name="password">
            <label for="register_password_repeat">Powtórz hasło:</label>
            <input type="password" id="password_repeat" name="password_repeat">
            <button type="submit">Zarejestruj się</button>
        </form>
    </div>

    <div class="container">
        <h2>Logowanie</h2>
            <form action="login.php" method="POST">
                <label for="login_email">Email:</label>
                <input type="email" id="l_email" name="email" required>
                <label for="login_password">Hasło:</label>
                <input type="password" id="l_password" name="password" required>
                <button type="submit">Zaloguj się</button>
            </form>
    </div>
</body>
</html>