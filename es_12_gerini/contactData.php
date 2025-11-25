<?php
session_start();
    if (isset($_POST["nPhone"],$_POST["nHouse"],$_POST["addres"],$_POST["inst"])){
    

    $dati = [
        "nPhone" => $_POST["nPhone"],
        "nHouse" => $_POST["nHouse"],
        "addres" => $_POST["addres"],
        "inst"   => $_POST["inst"]
    ];

    $_SESSION["dati"] += $dati;
    header("Location:show.php");
    exit;
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
        <label for="">Numero di telefono:</label>
        <input type="text" name="nPhone"><br><br>

        <label for="">Numero fisso:</label>
        <input type="text" name="nHouse"><br><br>

        <label for="">Indirizzo:</label>
        <input type="text" name="addres"><br><br>

        <label for="inst">Instagram:</label>
        <input type="text" name="inst"><br><br>

        <input type="submit" value="Invia">
    </form>
</body>
</html>