<!DOCTYPE html>
<html>
<head>
    <title>Przelicznik walut</title>
</head>
<body>

<form action="" method="post">
    <label for="imie">Imię:</label>
    <input type="text" name="imie">
    <label for="nazwisko">Nazwisko:</label>
    <input type="text" name="nazwisko">
    <br><br>
    <label for="zloty">Złoty:</label>
    <input type="text" name="zloty">
    <br><br>
    <label for="euro">Euro:</label>
    <input type="text" name="euro">
    <br><br>
    <label for="dolar">Dolar:</label>
    <input type="text" name="dolar">
    <br><br>
    <input type="submit" value="Zlicz">
</form>

<?php 
    include 'functions.php';
    ?> 

</body>
</html>