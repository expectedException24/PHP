<?php
session_start();

if (isset($_SESSION["utente"])) {
    header("Location: home.php");
    exit;
}elseif(isset($_POST["username"],$_POST["password"])) {
    login($_POST["username"],$_POST["password"]);
}else{
    
}

function login($inputUsername, $inputPassword) {
    $utenti = [
        "admin" => "1234",
        "mario" => "abcd",
        "giulia" => "pass123",
        "luca" => "ciao2024"
    ];

    if (isset($utenti[$inputUsername]) && $utenti[$inputUsername] === $inputPassword) {
        $_SESSION["utente"] = $inputUsername;
        header("Location: home.php");
        exit;
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container text-center">
        <div class="card p-4 shadow-sm" style="max-width: 400px; margin: auto;">
                <h2 class="mb-3">Login</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Accedi</button>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>
