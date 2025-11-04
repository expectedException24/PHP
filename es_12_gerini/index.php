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
        'desc' => 'Rosmarino coltivato e raccolto a san colombano',
        'pic' => './images/rosmarino.jpg',
    ],
    [
        'name' => 'Succo alla mela',
        'price' => 19.99,
        'desc' => 'Succo 100% Polacco ',
        'pic' => './images/succoallamela.jpg',
    ],
]; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodotti</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS separato per personalizzazioni aggiuntive (se necessarie) -->
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <?php mostraProdotti($prodotti); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
<?php
if (!isset($_SESSION['cart'])) {
    $_SESSION[''] = [];
}
if (!isset($_POST[''])) {

}


function mostraProdotti($prodotti)
{
    if (empty($prodotti)) {
        echo "Nessun prodotto disponibile.";
        return;
    }

    $i = 0;
    foreach ($prodotti as $prodotto) {
        $i++;
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
        echo '<form method="POST"><button class="btn btn-primary" name="' . $i . '">Add</button></form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

}