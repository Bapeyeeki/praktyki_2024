<!DOCTYPE html>
<html>
<head>
    <title>Przelicznik walut!</title>
</head>
<body>
<!-- <form action="" method="post"> -->
<label for="imie">Imię:</label>
    <input type="text" name="imie" id="imie">
    <label for="nazwisko">Nazwisko:</label>
    <input type="text" name="nazwisko" id="nazwisko">
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
    <input type="submit" value="Zlicz" onclick="submitForm()">
<!-- </form> -->

<script>
    async function submitForm() {
        var formData = new FormData();
        formData.append('imie', document.getElementById('imie').value);
        formData.append('nazwisko', document.getElementById('nazwisko').value);
        formData.append('zloty', document.getElementsByName('zloty')[0].value);
        formData.append('euro', document.getElementsByName('euro')[0].value);
        formData.append('dolar', document.getElementsByName('dolar')[0].value);
   
        const response = await postData(formData);
        document.getElementById('result').innerHTML = response;
    }

    async function postData(formData) {
        const response = await fetch("licznik.php", {
            method: "POST",
            body: formData
        });

        const body = await response.text();
        return body;
    }
</script>
<div id="result">
    <?php 
        include 'licznik.php';
    ?> 
</div>

<div></div>
</body>
</html>