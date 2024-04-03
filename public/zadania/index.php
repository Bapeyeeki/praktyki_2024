<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    if(!isset($_SESSION['x'])) {
        $_SESSION['x'] = rand(1, 100);
    }

    echo $_SESSION['x'];

    $num = $_POST['num'];

    if(isset($_POST['submit'])){
        $num = $_POST['num'];

        if($num < $_SESSION['x']) {
            echo "Your number is lower <br>";
        }elseif($num > $_SESSION['x']) {
            echo "Your numer is higher <br>";
        }elseif($num == $_SESSION['x']){
            echo "Congratulations";
            session_unset();
        }
    }

?>

<p>
    <form action="" method="post">
        <input type="text" name="num">
        <button type="submit" name="submit">Guess</button>
        <button type="reset" name="Reset">Reset</button>
    </form>
</p>
</body>
</html>



