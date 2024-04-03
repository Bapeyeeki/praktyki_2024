<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calkulator</title>
</head>
<body>
        <form method="post">
            <input type="number" name="numb1"><br><br>
            <input type="number" name="numb2"><br><br>
            <select name="operator" id="">
               <option>None</option>
               <option>Add</option>
               <option>Subtract</option>
               <option>Multiply</option>
               <option>Divide</option>
               <option>Square</option>
            </select>
            <button type="submit" name="submit" value="submit">Calculate</button>
         </form>

         <?php 

         if (isset($_POST['submit'])) {
             $result1 = $_POST['numb1'];
             $result2 = $_POST['numb2'];
             $operator = $_POST['operator'];
             switch ($operator) {
                 case 'None':
                     echo "<br>";
                     echo "Wybierz opercaje";
                     break;
                 case 'Add':
                     echo "<br>";
                     echo $result1 + $result2;
                     break;
                 case 'Subtract':
                     echo "<br>";
                     echo $result1 - $result2;
                     break;
                 case 'Multiply':
                     echo "<br>";
                     echo $result1 * $result2;
                     break;
                 case 'Divide':
                     echo "<br>";
                     echo $result1 / $result2;
                     break;
                 case 'Square':
                     echo "<br>";
                     echo $result1 ** $result2;
                     break;
             }
         }
      ?>
</body>
</html>