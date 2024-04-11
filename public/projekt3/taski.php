<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
</head>
<body>
    <!--
    <form action="index.php" method="post">
        
       
    </form>
-->
        Opis zadania: <input type="text" name="zadanie" id="zadanie"><br><br>
        Status zadania: <input type="number" min="0" max="1" name="status" id="is_done"><br><br>
        <input type="submit" value="zapisz" name="submit" onclick="submitForm()">
        <input type="reset" value="reset"><br>
    <br>

    <form action="index.php" method="post">
        <label for="search">Wyszukaj zadanie:</label>
        <input type="text" name="search" id="search"><br><br>
        <input type="submit" value="Szukaj">
        <input type="submit" name="reset" value="Cofnij wyszukiwanie">
    </form>

    <br>

    <form action="index.php" method="post">
        <label for="sort">Sortuj:</label>
        <select name="sort" id="sort">
            <option value="status">Wg. statusu</option>
            <option value="opis">Wg. opisu zadania</option>
        </select>
        <input type="submit" value="Sortuj">
    </form>

    <br>

    <script>
        
        async function submitForm()
        {
            var opis = document.getElementById('zadanie').value
            var status = document.getElementById('is_done').value
                
            const response = await postData(opis, status, 'sport');
            document.getElementById('lista').innerHTML = response;
        }

        async function postData(opis, status, search) {
            const response = await fetch("list.php?zadanie=" + opis + "&status=" + status + '&submit=true&search=' + search);
            
            const body = await response.text();
            return body;
        }  
    
    </script>

<div id="lista">
    <?php 
    include 'list.php'; 
    ?>  
</div>
</body>
</html>