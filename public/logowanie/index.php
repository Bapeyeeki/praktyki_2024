<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
    <form action="includes/singup.inc.php" method="post">
        <input type="text" name="uid" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <input type="password" name="pwdrepeat" placeholder="Repeat Password">
        <br>
        <br>
        <button type="submit" name="submit">SIGN UP</button>
    </form>

    <br>
    <form action="includes/login.inc.php" method="post">
    <input type="text" name="uid" placeholder="Username">
    <input type="password" name="pwd" placeholder="Password">
    <br>
    <br>
    <button type="submit" name="sumbit">LOGIN</button>
    </form>
</body>
</html>