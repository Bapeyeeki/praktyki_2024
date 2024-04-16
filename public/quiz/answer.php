<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['answer'])) {
    // Sprawdzenie odpowiedzi
    $currentQuestion = $_SESSION['current_question'];
    $questions = $_SESSION['questions'];

    if ($_POST["answer"] == $questions[$currentQuestion]['correct']) {
        $_SESSION['score']++;
    }

    $_SESSION['current_question']++;

    if ($_SESSION['current_question'] >= count($questions)) {
        // Jeśli użytkownik odpowiedział na wszystkie pytania, przekieruj go do podsumowania
        $_SESSION['category'] = $_GET['category']; // Przechowujemy kategorię w sesji
        header("Location: summary.php");
        exit;
    } else {
        // Jeśli są jeszcze pytania, przekieruj użytkownika do kolejnego pytania
        header("Location: question.php?category=" . urlencode($_GET['category']));
        exit;
    }
} else {
    // Jeśli użytkownik próbuje uzyskać dostęp do answer.php bez odpowiedzi na pytanie, przekieruj go na stronę główną
    header("Location: index.php");
    exit;
}