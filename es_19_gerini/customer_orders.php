<?php
require_once 'connection.php';

$customerNumber = $_GET['customerNumber'];

echo '<h2>Ordini per cliente: ' . $customerNumber . '</h2>';

$res = $conn->query("SELECT orderNumber, orderDate, requiredDate, shippedDate, status FROM orders WHERE customerNumber = $customerNumber ORDER BY orderDate DESC");

echo '<table border="1" cellspacing="0" cellpadding="4">';
echo '<tr><th>orderNumber</th><th>orderDate</th><th>requiredDate</th><th>shippedDate</th><th>status</th></tr>';
while ($row = $res->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row['orderNumber'] . '</td>';
    echo '<td>' . $row['orderDate'] . '</td>';
    echo '<td>' . $row['requiredDate'] . '</td>';
    echo '<td>' . $row['shippedDate'] . '</td>';
    echo '<td>' . $row['status'] . '</td>';
    echo '</tr>';
}
echo '</table>';

$res->free();
$conn->close();

?>
