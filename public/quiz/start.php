<?php
session_start();

require_once 'TriviaAPI.php';
require_once 'Categories.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start_quiz'])) {
    $selectedCategory = $_POST['category'];

    $api = new TriviaAPI("https://opentdb.com/api.php");
    $categories = new Categories($api);

    // Pobierz pytania dla wybranej kategorii
    $questions = $categories->getQuestions($selectedCategory);

    if ($questions !== null) {
        $_SESSION['questions'] = $questions;
        $_SESSION['current_question'] = 0;
        $_SESSION['score'] = 0;

        // Przekieruj do strony z pytaniami
        header("Location: question.php");
        exit;
    } else {
        echo "Błąd: Brak pytań dla wybranej kategorii.";
    }
}
?>

<!-- Formularz wyboru kategorii -->
<h2>Wybierz kategorię:</h2>
<form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <select name="category">
        <option value="9">Ogólne</option>
        <option value="18">Nauka komputerowa</option>
        <option value="17">Nauka o naturze</option>
        <!-- Dodaj więcej opcji kategorii -->
    </select>
    <br><br>
    <input type="submit" name="start_quiz" value="Rozpocznij quiz">
</form>