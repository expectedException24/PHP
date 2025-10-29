<?php
session_start();
if (!isset($_SESSION["utente"])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Benvenuto Admin</span>
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
</nav>


</body>
</html>
