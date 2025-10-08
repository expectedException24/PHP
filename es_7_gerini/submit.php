<?php
if($_GET['name'] && $_GET['surname'] && $_GET['mail']){
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Campo</th><th>Valore</th></tr>";
    echo "<tr><td>Nome</td><td>" . htmlspecialchars($_GET['name']) . "</td></tr>";
    echo "<tr><td>Cognome</td><td>" . htmlspecialchars($_GET['surname']) . "</td></tr>";
    echo "<tr><td>Email</td><td>" . htmlspecialchars($_GET['mail']) . "</td></tr>";
    echo "</table>";
    echo "<h1>dati inviati</h1>";
} else {
    echo "Dati mancanti.";
}
?>
