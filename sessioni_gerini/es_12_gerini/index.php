<?php
session_start();

$prodotti = [
    [
        'name' => 'Prosciutto',
        'price' => 29.99,
        'desc' => 'Prosciutto 100% albanese',
        'pic' => './images/prosciutto.jpg',
    ],
    [
        'name' => 'Rosmarino',
        'price' => 49.99,
        'desc' => 'Rosmarino coltivato e raccolto a San Colombano',
        'pic' => './images/rosmarino.jpg',
    ],
    [
        'name' => 'Succo alla mela',
        'price' => 19.99,
        'desc' => 'Succo 100% Polacco',
        'pic' => './images/succoallamela.jpg',
    ],
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($prodotti as $index => $prodotto) {
        if (isset($_POST['add_' . $index])) {
            $name = $prodotto['name'];
            if (isset($_SESSION['cart'][$name])) {
                $_SESSION['cart'][$name]['qty']++;
            } else {
                $_SESSION['cart'][$name] = [
                    'price' => $prodotto['price'],
                    'qty' => 1
                ];
            }
        }
    }
}

function mostraProdotti($prodotti)
{
    foreach ($prodotti as $index => $prodotto) {
        $name = $prodotto['name'];
        $price = $prodotto['price'];
        $desc = $prodotto['desc'];
        $pic = $prodotto['pic'];

        echo '<div class="col-md-4 col-sm-6 col-12 mb-4">';
        echo '<div class="card shadow-sm">';
        echo '<img src="' . $pic . '" alt="' . $name . '" class="card-img-top">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $name . '</h5>';
        echo '<p class="card-text">' . $desc . '</p>';
        echo '<p class="card-text">€ ' . number_format($price, 2, ',', '.') . '</p>';
        echo '<form method="POST">';
        echo '<button class="btn btn-primary" name="add_' . $index . '">Aggiungi al carrello</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodotti</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>I nostri prodotti</h1>
            <form action="carrello.php" method="get">
                <button type="submit" class="btn btn-primary">Ordina merce</button>
            </form>
        </div>

        <div class="row">
            <?php mostraProdotti($prodotti); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
