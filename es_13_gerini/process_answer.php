<?php
session_start();
include('quizdata.php');
$questionIndex = $_POST['question_index'];
$answers       = $_POST['answer'];
$action        = $_POST['action'];
$_SESSION['stored_answers'][$questionIndex] = $answers;
if ($action === "next") {
    $_SESSION['current_question']++;
    header("Location: index.php");
    exit;
}
if ($action === "finish") {
    $userAnswers = $_SESSION['stored_answers'];
    $total = count($quiz);
    $score = 0;
    for ($i = 0; $i < $total; $i++) {

        $correct   = $quiz[$i]['correct'];
        $user      = $userAnswers[$i] ?? [];
        sort($correct);
        sort($user);

        if ($correct === $user) {
            $score++;
        }
    }
    echo "<h1>Punteggio: $score / $total</h1>";
    // session_destroy();
    exit;
}
