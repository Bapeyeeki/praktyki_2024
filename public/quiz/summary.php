<?php
session_start();

// Sprawdzenie czy sesja została zainicjowana i czy przekazano odpowiedzi
if (isset($_SESSION['questions']) && isset($_POST['answers'])) {
    // Pobranie udzielonych odpowiedzi
    $selectedAnswers = $_POST['answers'];

    // Pobranie prawidłowych odpowiedzi z sesji
    $questions = $_SESSION['questions'];
    $correctAnswers = array_column($questions, 'correct_answer');

    // Inicjalizacja licznika poprawnych odpowiedzi
    $score = 0;

    // Porównanie udzielonych odpowiedzi z prawidłowymi odpowiedziami
    foreach ($selectedAnswers as $index => $selectedAnswer) {
        if (isset($correctAnswers[$index]) && isset($selectedAnswer) && $selectedAnswer === $correctAnswers[$index]) {
            $score++;
        }
    }

    // Wyświetlenie wyniku
    echo "<h1>Twój wynik: $score/" . count($questions) . "</h1>";

    // Wyświetlenie pojedynczych pytań z odpowiedziami i ich poprawnością
    echo "<h2>Pytania i odpowiedzi:</h2>";
    foreach ($questions as $index => $question) {
        $correctAnswer = isset($correctAnswers[$index]) ? $correctAnswers[$index] : 'Nieokreślona';
        $selectedAnswer = isset($selectedAnswers[$index]) ? $selectedAnswers[$index] : 'Brak odpowiedzi';
        echo "<p>Pytanie: " . htmlspecialchars($question['question']) . "</p>";
        echo "<p>Twoja odpowiedź: " . htmlspecialchars($selectedAnswer) . "</p>";
        echo "<p>Poprawna odpowiedź: " . htmlspecialchars($correctAnswer) . "</p>";
        if (isset($selectedAnswers[$index]) && isset($correctAnswers[$index]) && $selectedAnswer === $correctAnswer) {
            echo "<p style='color: green;'>Odpowiedź poprawna!</p>";
        } else {
            echo "<p style='color: red;'>Odpowiedź niepoprawna.</p>";
        }
        echo "<hr>";
    }

    // Usunięcie sesji z pytaniami po sprawdzeniu wyniku
    unset($_SESSION['questions']);
} else {
    // Komunikat o braku odpowiedzi lub braku zainicjowanej sesji
    echo "Błąd: Brak odpowiedzi lub brak zainicjowanej sesji.";
}