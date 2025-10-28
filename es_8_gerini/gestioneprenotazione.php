<?php
$result = null;  // inizializzo la variabile

$waiters = ["Luca", "Maria", "Giovanni", "Elena", "Marco"];

if(isset($_GET['name'], $_GET['surname'], $_GET['nTable'], $_GET['time'], $_GET['extraSpec'], $_GET['menu'], $_GET['parking'])){
    $dati = [
        'name'       => htmlspecialchars($_GET['name']),
        'surname'    => htmlspecialchars($_GET['surname']),
        'nTable'     => htmlspecialchars($_GET['nTable']),
        'time'       => htmlspecialchars($_GET['time']),
        'extraSpec'  => htmlspecialchars($_GET['extraSpec']),
        'menu'       => is_array($_GET['menu']) ? array_map('htmlspecialchars', $_GET['menu']) : [htmlspecialchars($_GET['menu'])],
        'parking'    => htmlspecialchars($_GET['parking']),
        'waiter'     => $waiters[random_int(0, count($waiters) - 1)],
        'price'      => 0,
    ];

    // Chiamo la funzione solo se i dati ci sono
    $result = calcPrice($dati['menu'], $dati['parking']);
}

// La funzione calcPrice qui (come la versione completa con dettagli)
function calcPrice(array $menu, string $parking): array {
    if (count($menu) === 1 && in_array('antipasto', $menu)) {
        return ['error' => "Non è possibile ordinare solo l'antipasto.", 'total' => 0];
    }

    $prices = [
        'antipasto' => 5,
        'primo'     => 6,
        'secondo'   => 7,
    ];

    $total = 0;
    $details = [];

    foreach ($menu as $item) {
        $price = $prices[$item] ?? 0;
        $details[] = ['item' => $item, 'price' => $price];
        $total += $price;
    }

    $discount = 0;
    if (in_array('primo', $menu) && in_array('secondo', $menu) && in_array('antipasto', $menu)) {
        $discount = $total * 0.15;
    } elseif (in_array('primo', $menu) && in_array('secondo', $menu)) {
        $discount = $total * 0.10;
    }

    $total -= $discount;

    $parkingCost = 0;
    if ($parking === 'non_custodito') $parkingCost = 3;
    elseif ($parking === 'custodito') $parkingCost = 5;

    $total += $parkingCost;

    return [
        'error' => null,
        'details' => $details,
        'discount' => round($discount, 2),
        'parking' => $parking,
        'parking_cost' => $parkingCost,
        'total' => round($total, 2),
    ];
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <title>Resoconto</title>
</head>

<body>
    <?php if ($result !== null): ?>
    <?php if ($result['error']): ?>
    <p style="color:red;">Errore: <?= htmlspecialchars($result['error']) ?></p>
    <?php else: ?>
    <h2>Riepilogo ordine</h2>
    <ul>
        <?php foreach ($result['details'] as $d): ?>
        <li><?= ucfirst($d['item']) ?>: €<?= number_format($d['price'], 2) ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Sconto applicato: €<?= number_format($result['discount'], 2) ?></p>
    <p>Parcheggio (<?= $result['parking'] ?: 'nessuno' ?>): €<?= number_format($result['parking_cost'], 2) ?></p>
    <p><strong>Totale: €<?= number_format($result['total'], 2) ?></strong></p>
    <?php endif; ?>
    <?php else: ?>
    <p>Compila il form per visualizzare il riepilogo.</p>
    <?php endif; ?>
</body>

</html>