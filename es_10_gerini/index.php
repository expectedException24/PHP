<?php
session_start();

if (isset($_POST['reset'])) {
    session_destroy();
}

if (isset($_SESSION['contatore'])) {
    $_SESSION['contatore']++;
} else {
    $_SESSION['contatore'] = 1;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatore Visite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

    <div class="container text-center">
        <div class="card shadow-sm p-4">
            <h1 class="mb-3">Contatore di Visite</h1>
            <p class="fs-5">
                Hai visitato questa pagina 
                <strong><?php echo $_SESSION['contatore']; ?></strong> 
                volta/e durante questa sessione.
            </p>

            <form method="post">
                <button type="submit" name="reset" class="btn btn-danger mt-3">
                    Azzera contatore
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
