<?php
session_start();
    if (isset($_POST["name"],$_POST["surname"],$_POST["codeF"],$_POST["email"])){

    $dati = [
        "name"    => $_POST["name"],
        "surname" => $_POST["surname"],
        "codeF"   => $_POST["codeF"],
        "email"   => $_POST["email"]
    ];

    $_SESSION["dati"] = $dati;
    header("Location:contactData.php");
    exit;
    }elseif(isset($_SESSION["dati"])){
        
    }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="name"><br><br>

        <label for="nome">Cognome:</label>
        <input type="text" name="surname"><br><br>

        <label for="nome">Codice fiscale:</label>
        <input type="text" name="codeF"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email"><br><br>

        <input type="submit" value="Invia">
    </form>

</body>
</html>