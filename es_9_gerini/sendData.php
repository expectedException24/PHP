<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Prenotazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="p-4">
    <?php
        if (isset($_POST['name'], $_POST['email'], $_POST['textArea'])) {

            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $textArea = htmlspecialchars($_POST['textArea']);

            echo "<div class='card p-3 shadow-sm'>";
            echo "<h2 class='mb-3'>Dati ricevuti:</h2>";
            echo "<p><strong>Nome:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>dati aggiuntivi:</strong> $textArea</p>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-warning'>Compila il form prima di inviare.</div>";
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>