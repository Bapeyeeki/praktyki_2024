<?php
// Funkcja inicjująca nowy quiz
function startNewQuiz() {
    // Import zestawu pytań
    include 'questions.php';

    // Przemieszanie pytań
    shuffle($questions);

    // Wybierz tylko pierwsze 10 pytań
    $selectedQuestions = array_slice($questions, 0, 10);

    // Przemieszanie wybranych pytań
    shuffle($selectedQuestions);

    // Zainicjowanie wyniku
    $_SESSION['score'] = 0;

    // Ustawienie bieżącego pytania
    $_SESSION['current_question'] = 0;

    // Zapisanie przemieszanych pytań do sesji
    $_SESSION['questions'] = $selectedQuestions;

    // Przemieszanie odpowiedzi dla każdego pytania
    foreach ($_SESSION['questions'] as &$question) {
        shuffle($question['options']);
    }
}