<?php
$servername = "mysql";
$username = "v.je";
$password = "v.je";
$db = "praktyki";

try {
    $conn = new PDO("mysql:host=$servername;dbname=praktyki", $username, $password);
    // Ustawienie trybu wyjątków PDO na ERRMODE_EXCEPTION
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "udane połaczenie";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $imie = isset($_POST["imie"]) ? $_POST["imie"] : '';
        $nazwisko = isset($_POST["nazwisko"]) ? $_POST["nazwisko"] : '';
        $zloty = isset($_POST["zloty"]) ? $_POST["zloty"] : 0;
        $euro = isset($_POST["euro"]) ? $_POST["euro"] : 0;
        $dolar = isset($_POST["dolar"]) ? $_POST["dolar"] : 0;

        $converter = new CurrencyConverter($conn);
        $total_pln = $converter->convertToPLN($zloty, $euro, $dolar);

        if (is_numeric($total_pln)) {
            echo "<br>Witaj, $imie $nazwisko!<br><b>Twoja suma w złotówkach wynosi: $total_pln zł</b>";

            $converter->insertToDatabase($imie, $nazwisko, $total_pln);
        } else {
            echo $total_pln;
        }
    }

     // Wyświetlenie rekordów z bazy danych
     $records = $converter->showRecordsFromDatabase();
     echo "<h2>Nasi klienci:</h2>";
     foreach ($records as $record) {
         echo "Imię: " . $record['imie'] . ", Nazwisko: " . $record['nazwisko'] . ", Suma w złotówkach: " . $record['suma_zloty'] . "<br>";
     }

} catch(PDOException $e) {

    // Obsługa błędów
    die("Connection failed: " . $e->getMessage());
} finally {
    
    // Zamknięcie połączenia
    $conn = null;
}
