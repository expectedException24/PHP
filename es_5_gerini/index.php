    <?php
        $GRADES=[7, 5, 6, 8, 9]; // da finire 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <?php
        echo "<p style='color: green; font-size: " . rand(16, 40) . "px;'>$str</p>";
        echo "<p style='color: blue; font-size: " . rand(16, 40) . "px;'>".strtoupper($str)."</p>";
    ?>
    <?php
        echo"<h1 style='color: red;'>Il paragrafo ha ".str_word_count($str)." parole </h1>";
        echo"<h1 style='color: yellow;'>Il paragrafo ha ".strlen($str)." parole </h1>";
    ?>

    
</body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
