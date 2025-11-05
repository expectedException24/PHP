<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Resoconto Carrello</h1>

        <?php if (!empty($_SESSION['cart'])): ?>
            <table class="table table-bordered mt-4">
                <thead class="table-light">
                    <tr>
                        <th>Prodotto</th>
                        <th>Prezzo Unitario</th>
                        <th>Quantità</th>
                        <th>Totale</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totale = 0;
                    foreach ($_SESSION['cart'] as $name => $item):
                        $subtot = $item['price'] * $item['qty'];
                        $totale += $subtot;
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($name) ?></td>
                            <td>€ <?= number_format($item['price'], 2, ',', '.') ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td>€ <?= number_format($subtot, 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Totale generale:</th>
                        <th>€ <?= number_format($totale, 2, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-secondary">← Torna ai prodotti</a>
            </div>
        <?php else: ?>
            <p class="mt-4">Il carrello è vuoto.</p>
            <a href="index.php" class="btn btn-primary mt-3">Vai ai prodotti</a>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
