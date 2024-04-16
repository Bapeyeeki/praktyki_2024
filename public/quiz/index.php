<?php
session_start();

// Import zestawu pytań
include 'categories.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start_quiz'])) {
    $selectedCategory = $_POST['category'];
    $selectedQuestions = $categories[$selectedCategory];
    shuffle($selectedQuestions);

    $_SESSION['questions'] = $selectedQuestions;
    $_SESSION['current_question'] = 0;
    $_SESSION['score'] = 0;

    // Przekierowanie do strony z pytaniami
    header("Location: question.php?category=" . urlencode($selectedCategory)); // Przekazanie wybranej kategorii jako część adresu URL
    exit;
}
?>

<!-- Formularz wyboru kategorii -->
<h2>Wybierz kategorię:</h2>
<form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <select name="category">
        <option value="Matematyka">Matematyka</option>
        <option value="Programowanie">Programowanie</option>
        <option value="Biologia">Biologia</option>
        <option value="Geografia">Geografia</option>
    </select>
    <br><br>
    <input type="submit" name="start_quiz" value="Rozpocznij quiz">
</form>