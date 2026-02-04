<?php
require_once 'connection.php';

$tablesRes = $conn->query("SHOW TABLES");
$tables = [];
if ($tablesRes) {
    while ($tblRow = $tablesRes->fetch_row()) {
        $tables[] = $tblRow[0];
    }
    $tablesRes->free();
} else {
    echo '<p>Errore nella lettura delle tabelle: ' . htmlspecialchars($conn->error) . '</p>';
}
?>
<!doctype html>
<html lang="en">
<head>

</head>
<body>
    <?php

        echo "<h2>" . htmlspecialchars('customers') . "</h2>";

        $res = $conn->query("SELECT * FROM customers ");

        echo "<table id='customers' border='1' cellspacing='0' cellpadding='4'><thead><tr>";
        $fields = $res->fetch_fields();
        foreach ($fields as $f) {
            echo "<th>" . htmlspecialchars($f->name) . "</th>";
        }
        echo "</tr></thead><tbody>";

        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            foreach ($fields as $f) {
                $col = $f->name;
                $val = isset($row[$col]) ? $row[$col] : '';
                if ($f->name === 'customerNumber') {
                    $link = 'customer_orders.php?customerNumber=' . rawurlencode($val);
                    echo '<td><a href="' . htmlspecialchars($link) . '">' . htmlspecialchars((string)$val) . '</a></td>';
                } else {
                    echo '<td>' . htmlspecialchars((string)$val) . '</td>';
                }

            }
            echo "</tr>";
        }
        echo "</tbody></table><br/>";
        $res->free();
        

    $conn->close();
    ?>
</body>
</html>