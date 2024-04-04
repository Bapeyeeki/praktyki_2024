<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobieramy dane z formularza
    $zloty = isset($_POST["zloty"]) ? (float)$_POST["zloty"] : 0;
    $euro = isset($_POST["euro"]) ? (float)$_POST["euro"] : 0;
    $dolar = isset($_POST["dolar"]) ? (float)$_POST["dolar"] : 0;

    // Kursy wymiany
    $exchange_rates = [
        "Zloty" => 1,
        "Euro" => 4.35, // Załóżmy, że 1 euro = 4.35 złotych
        "Dolar" => 3.70  // Załóżmy, że 1 dolar = 3.70 złotych
    ];

    // Sumujemy wartości w złotówkach
    $total_pln = $zloty + ($euro * $exchange_rates["Euro"]) + ($dolar * $exchange_rates["Dolar"]);
    echo "Suma w złotówkach: $total_pln zł";
}
