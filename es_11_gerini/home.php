<?php
session_start();
if (!isset($_SESSION["utente"])) {
    header("Location: index.php");
    exit;
}
if(isset($_POST["numero_tavolo"])){
    $_SESSION['tavoli'][$_POST["numero_tavolo"]]=;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Tavoli - <?= htmlspecialchars($_SESSION['utente']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>👨‍🍳 Cameriere: <?= htmlspecialchars($_SESSION['utente']) ?></h2>
            <form method="POST">
                <button type="submit" name="logout" class="btn btn-danger">Chiudi Turno</button>
            </form>
        </div>

        <!-- Aggiungi tavolo -->
        <form method="POST" class="mb-3">
            <div class="input-group">
                <input type="number" name="numero_tavolo" class="form-control" placeholder="Numero tavolo" required>
                <button type="submit" name="nuovo_tavolo" class="btn btn-success">Aggiungi Tavolo</button>
            </div>
        </form>

        <!-- Elenco tavoli -->
        <?php if (!empty($_SESSION['tavoli'])): ?>
            <?php foreach ($_SESSION['tavoli'] as $numero => $tavolo): ?>
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Tavolo <?= $numero ?>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($tavolo['piatti'])): ?>
                            <ul class="list-group mb-3">
                                <?php
                                $totale = 0;
                                foreach ($tavolo['piatti'] as $p):
                                    $totale += $p['prezzo'];
                                ?>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <?= htmlspecialchars($p['nome']) ?>
                                        <span>€ <?= number_format($p['prezzo'], 2, ',', '.') ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <h5>Totale: € <?= number_format($totale, 2, ',', '.') ?></h5>
                        <?php else: ?>
                            <p>Nessuna comanda ancora.</p>
                        <?php endif; ?>

                        <!-- Aggiungi piatto -->
                        <form method="POST" class="mt-3">
                            <input type="hidden" name="numero_tavolo" value="<?= $numero ?>">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="text" name="nome_piatto" class="form-control" placeholder="Nome piatto" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="prezzo" step="0.01" class="form-control" placeholder="Prezzo (€)" required>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" name="aggiungi_piatto" class="btn btn-outline-primary w-100">Aggiungi Piatto</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nessun tavolo assegnato. Aggiungine uno sopra 👆</p>
        <?php endif; ?>
    </div>
</body>
</html>