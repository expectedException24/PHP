<?php
require 'connection.php';
header('Content-Type: application/json; charset=utf-8');
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if($q === ''){ echo json_encode([]); exit; }

$like = "%" . $conn->real_escape_string($q) . "%";
$sql = "SELECT customerNumber, customerName, contactFirstName, contactLastName FROM customers WHERE customerName LIKE ? OR contactFirstName LIKE ? OR contactLastName LIKE ? LIMIT 15";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss',$like,$like,$like);
$stmt->execute();
$res = $stmt->get_result();
$out = [];
while($row = $res->fetch_assoc()){
  $label = $row['customerNumber'] . ' - ' . $row['customerName'];
  $out[] = ['value'=>$row['customerNumber'], 'label'=>$label];
}
echo json_encode($out);
?>
