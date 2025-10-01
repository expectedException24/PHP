<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        <button type="submit" class="btn btn-primary">randomize</button>
    </form>
    <?php
        $num=rand(1,6);
        $row = intval(($num - 1) / 3);
        $col = ($num - 1) % 3;
        $class="part-$row-$col";
        echo"    
            <div class='crop-container $class'>
            <img src='./images/dadi.jpg'>
            </div>
        ";
    ?>
    <?php
        $num=rand(1,6);
        $row = intval(($num - 1) / 3);
        $col = ($num - 1) % 3;
        $class="part-$row-$col";
        echo"    
            <div class='crop-container $class'>
            <img src='./images/dadi.jpg'>
            </div>
        ";
    ?>
    
</body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
