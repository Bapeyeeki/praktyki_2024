<!DOCTYPE html>
<html>
<head>
    <title>Przelicznik walut</title>
</head>
<body>

<form action="" method="post">
    <label for="zloty">Złoty:</label>
    <input type="text" name="zloty">
    <br>
    <label for="euro">Euro:</label>
    <input type="text" name="euro">
    <br>
    <label for="dolar">Dolar:</label>
    <input type="text" name="dolar">
    <br>
    <input type="submit" value="Zlicz">
</form>

<?php 
    include 'licznik.php'; 
    ?> 

</body>
</html>