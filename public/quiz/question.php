<?php
session_start();

$currentQuestion = $_SESSION['current_question'];
$questions = $_SESSION['questions'];

if(isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
} else {
    // Obsługa błędu, gdyby zmienna category nie została przekazana w adresie URL
    echo "Błąd: Nie wybrano kategorii.";
    exit;
}

echo '<h1>Prosty Quiz z ' . $selectedCategory . '</h1>';
echo '<form method="post" action="answer.php?category=' . urlencode($selectedCategory) . '">'; // Przekazanie kategorii jako część adresu URL
echo '<h2>' . $questions[$currentQuestion]['question'] . '</h2>';
foreach ($questions[$currentQuestion]['options'] as $option) {
    echo '<input type="radio" name="answer" value="' . $option . '">' . $option . '<br>';
}
echo '<br>';
echo '<input type="submit" name="submit" value="Sprawdź odpowiedź">';
echo '</form>';