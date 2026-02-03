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
        $selected = 'customers';

        if ($selected !== '' && in_array($selected, $tables, true)) {
            $tablesToShow = [$selected];
        } else {
            $tablesToShow = [];
            if ($selected !== '') {
                echo '<p>Tabella selezionata non trovata: ' . htmlspecialchars($selected) . '</p>';
            }
        }

        foreach ($tablesToShow as $table) {
            echo "<h2>" . htmlspecialchars($table) . "</h2>";

            $res = $conn->query("SELECT * FROM `{$table}`");
            if (!$res) {
                echo '<p>Errore nella lettura della tabella ' . htmlspecialchars($table) . ': ' . htmlspecialchars($conn->error) . "</p>";
                continue;
            }

            echo "<table border='1' cellspacing='0' cellpadding='4'><thead><tr>";
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
                    echo "<td>" . htmlspecialchars((string)$val) . "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table><br/>";
            $res->free();
        }

        $conn->close();
    ?>
</body>
</html>