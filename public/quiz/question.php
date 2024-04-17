<?php
session_start();

if (!isset($_SESSION['questions'])) {
    echo "Błąd: Brak pytań. Wróć do poprzedniej strony i rozpocznij quiz ponownie.";
    exit;
}

$questions = $_SESSION['questions'];
$totalQuestions = count($questions);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['answers'])) {
    // Pobranie udzielonych odpowiedzi
    $selectedAnswers = $_POST['answers'];

    // Inicjalizacja licznika poprawnych odpowiedzi
    $score = 0;

    // Porównanie udzielonych odpowiedzi z prawidłowymi odpowiedziami
    foreach ($selectedAnswers as $index => $selectedAnswer) {
        $correctAnswer = $questions[$index]['correct_answer'];
        if ($selectedAnswer === $correctAnswer) {
            $score++;
        }
    }

    // Wyświetlenie wyniku
    echo "<h1>Twój wynik: $score/$totalQuestions</h1>";

    // Usunięcie sesji z pytaniami po sprawdzeniu wyniku
    unset($_SESSION['questions']);
} else {
    // Wyświetlenie wszystkich pytań z odpowiedziami
    echo '<form method="post" action="question.php">';
    foreach ($questions as $index => $question) {
        echo '<h3>' . $question['question'] . '</h3>';
        foreach ($question['incorrect_answers'] as $incorrect_answer) {
            echo '<input type="radio" name="answers[' . $index . ']" value="' . htmlspecialchars($incorrect_answer) . '"> ' . htmlspecialchars($incorrect_answer) . '<br>';
        }
        echo '<input type="radio" name="answers[' . $index . ']" value="' . htmlspecialchars($question['correct_answer']) . '"> ' . htmlspecialchars($question['correct_answer']) . '<br>';
        echo '<br>';
    }
    echo '<input type="submit" name="submit" value="Sprawdź wynik">';
    echo '</form>';
}