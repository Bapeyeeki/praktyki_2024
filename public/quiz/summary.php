<?php
session_start();

if(!isset($_SESSION['category'])) {
    // Obsługa błędu, gdyby kategoria nie została przechowana w sesji
    echo "Błąd: Nie wybrano kategorii.";
    exit;
}

$selectedCategory = $_SESSION['category'];
$score = $_SESSION['score'];
$totalQuestions = count($_SESSION['questions']);
$percentage = ($score / $totalQuestions) * 100;

// Komunikat w zależności od wyniku
if ($percentage >= 80) {
    $message = "Świetnie Ci poszło!";
} elseif ($percentage >= 60) {
    $message = "Nieźle, ale można lepiej!";
} else {
    $message = "Musisz się jeszcze trochę pouczyć.";
}

echo "<h2>Twój wynik z kategorii $selectedCategory: $score/$totalQuestions</h2>";
echo "<p>$message</p>";

// Guzik zagraj ponownie
echo '<form method="post" action="index.php">';
echo '<input type="submit" name="restart" value="Zagraj ponownie">';
echo '</form>';

// Usuwamy kategorię z sesji, aby nie była dostępna po odświeżeniu strony
unset($_SESSION['category']);