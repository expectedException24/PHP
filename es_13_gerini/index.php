<?php
session_start();
include('quizdata.php');

if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
}

$total = count($quiz);
$current = $_SESSION['current_question'];
$question = $quiz[$current];
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h2>Domanda <?php echo $current; ?>/<?php echo $total; ?></h2>

<form method="post" action="process_answer.php">

    <input type="hidden" name="question_index" value="<?php echo $current; ?>">

    <h3><?php echo htmlspecialchars($question["question"]); ?></h3>

    <?php foreach ($question["answers"] as $i => $answer): ?>
        <label>
            <input type="radio" name="answer" value="<?php echo $i; ?>">
            <?php echo htmlspecialchars($answer); ?>
        </label><br>
    <?php endforeach; ?>

    <br>

    <?php if ($current < $total - 1): ?>
        <button type="submit" name="action" value="next">Avanti</button>
    <?php else: ?>
        <button type="submit" name="action" value="finish">Finisci</button>
    <?php endif; ?>

</form>

</body>
</html>