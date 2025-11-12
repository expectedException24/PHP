<?php
session_start();

// Rimuove solo l'utente corrente dalla sessione
unset($_SESSION["utente"]);

// Reindirizza alla pagina di login
header("Location: index.php");
exit;
?>
