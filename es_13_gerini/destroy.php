<?php
session_start();

// Rimuove solo l'utente corrente dalla sessione
session_destroy();

// Reindirizza alla pagina di login
header("Location: index.php");
exit;
?>
