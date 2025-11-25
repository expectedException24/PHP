<?php
session_start();

if (!isset($_SESSION["dati"]) || empty($_SESSION["dati"])) {
    echo "<p class='text-center mt-5'>Nessun dato presente.</p>";
    exit;
}

$dati = $_SESSION["dati"];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dati Inseriti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center mb-4">Dati Inseriti</h1>

    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            Dati Persona
        </div>
        <ul class="list-group list-group-flush">
            <?php
            foreach ($dati as $chiave => $valore) {
                echo '<li class="list-group-item"><strong>' . htmlspecialchars($chiave) . ':</strong> ' . htmlspecialchars($valore) . '</li>';
            }
            ?>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
