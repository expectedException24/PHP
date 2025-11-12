<?php
session_start();
$piatti = [
    ["nome" => "Spaghetti alla Carbonara", "prezzo" => 10.50],
    ["nome" => "Pizza Margherita", "prezzo" => 8.00],
    ["nome" => "Lasagna al Ragù", "prezzo" => 12.00],
    ["nome" => "Risotto ai Funghi", "prezzo" => 11.50],
    ["nome" => "Tiramisù", "prezzo" => 6.00],
    ["nome" => "Gnocchi al Pesto", "prezzo" => 9.50],
    ["nome" => "Fettuccine Alfredo", "prezzo" => 10.00],
    ["nome" => "Pizza Quattro Formaggi", "prezzo" => 9.00],
    ["nome" => "Bruschetta al Pomodoro", "prezzo" => 5.50],
    ["nome" => "Parmigiana di Melanzane", "prezzo" => 8.50],
    ["nome" => "Penne all’Arrabbiata", "prezzo" => 8.00],
    ["nome" => "Ossobuco alla Milanese", "prezzo" => 15.00],
    ["nome" => "Pollo alla Cacciatora", "prezzo" => 13.00],
    ["nome" => "Caponata Siciliana", "prezzo" => 7.50],
    ["nome" => "Gelato alla Stracciatella", "prezzo" => 4.50],
    ["nome" => "Cannoli Siciliani", "prezzo" => 5.00],
    ["nome" => "Zuppa di Lenticchie", "prezzo" => 6.50],
    ["nome" => "Calzone Prosciutto e Mozzarella", "prezzo" => 9.50],
    ["nome" => "Ravioli di Ricotta e Spinaci", "prezzo" => 11.00],
    ["nome" => "Pizza Diavola", "prezzo" => 9.50],
    ["nome" => "Torta della Nonna", "prezzo" => 5.50],
    ["nome" => "Insalata Caprese", "prezzo" => 7.00],
    ["nome" => "Focaccia Genovese", "prezzo" => 4.50],
    ["nome" => "Risotto allo Zafferano", "prezzo" => 12.50],
    ["nome" => "Arancini Siciliani", "prezzo" => 6.50],
    ["nome" => "Tagliatelle al Ragù", "prezzo" => 10.50],
    ["nome" => "Pizza Funghi e Salsiccia", "prezzo" => 10.00],
    ["nome" => "Panna Cotta", "prezzo" => 5.00],
    ["nome" => "Polenta con Funghi", "prezzo" => 9.00],
    ["nome" => "Risotto alla Milanese", "prezzo" => 13.00]
];


if (!isset($_SESSION["utente"])) {
    header("Location: index.php");
    exit;
}

$errore = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['aggiungi_tavolo'])) {
        $numero = (int) $_POST['numero_tavolo'];

        if ($numero < 1 || $numero > 10) {
            $errore = "Il numero del tavolo deve essere tra 1 e 10.";
        } else {

            $tavoliOccupati = [];
            if (isset($_SESSION['tavoli'])) {
                foreach ($_SESSION['tavoli'] as $utente => $tavoliUtente) { // array associativo di piatti vuoti
                    $tavoliOccupati = array_merge($tavoliOccupati, array_keys($tavoliUtente));
                }
            }

            if (in_array($numero, $tavoliOccupati)) {
                $errore = "Tavolo già occupato da un altro cameriere.";
            } else {
                if (!isset($_SESSION['tavoli'][$_SESSION['utente']][$numero])) {
                    $_SESSION['tavoli'][$_SESSION['utente']][$numero] = ['piatti' => []];
                }
            }
        }
    }

    if (isset($_POST['aggiungi_piatto'])) {
        $numero = (int) $_POST['numero_tavolo'];
        $nome = $_POST['nome_piatto'];
        $prezzo = 0;

        foreach ($piatti as $p) {
            if ($p['nome'] === $nome) {
                $prezzo = $p['prezzo'];
                break;
            }
        }

        if (!isset($_SESSION['tavoli'][$_SESSION['utente']][$numero])) {
            $_SESSION['tavoli'][$_SESSION['utente']][$numero] = ['piatti' => []];
        }

        $_SESSION['tavoli'][$_SESSION['utente']][$numero]['piatti'][] = [
            'nome' => htmlspecialchars($nome),
            'prezzo' => $prezzo
        ];
    }

} elseif (isset($_GET['logout'])) {
    header("Location:logout.php");
    exit;
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
            <form method="GET">
                <button type="submit" name="logout" class="btn btn-danger">Chiudi Turno</button>
            </form>
        </div>

        <?php if ($errore): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($errore) ?></div>
        <?php endif; ?>

        <form method="POST" class="mb-3">
            <div class="input-group">
                <input type="number" name="numero_tavolo" class="form-control" placeholder="Numero tavolo (1-10)"
                    required>
                <button type="submit" name="aggiungi_tavolo" class="btn btn-success">Aggiungi Tavolo</button>
            </div>
        </form>

        <?php
        $tavoli_utente = $_SESSION['tavoli'][$_SESSION['utente']] ?? [];
        if (!empty($tavoli_utente)): ?>
            <?php foreach ($tavoli_utente as $numero => $tavolo): ?>
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

                        <!-- Pulsante per eliminare il tavolo -->
                        <a href="destroy.php?tavolo=<?= $numero ?>" class="btn btn-danger mt-2">Reset</a>

                        <form method="POST" class="mt-3">
                            <input type="hidden" name="numero_tavolo" value="<?= $numero ?>">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <select name="nome_piatto" class="form-select" required>
                                        <option value="" disabled selected>Seleziona piatto</option>
                                        <?php foreach ($piatti as $p): ?>
                                            <option value="<?= htmlspecialchars($p['nome']) ?>">
                                                <?= htmlspecialchars($p['nome']) ?> - €
                                                <?= number_format($p['prezzo'], 2, ',', '.') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" name="aggiungi_piatto" class="btn btn-outline-primary w-100">Aggiungi
                                        Piatto</button>
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