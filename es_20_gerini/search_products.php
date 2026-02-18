<?php
session_start();

if (!isset($_SESSION["utente"])) {
    header("Location: ../es_21_gerini/index.php");
    exit;
}
require 'connection.php';
header('Content-Type: application/json; charset=utf-8');
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if($q === ''){ echo json_encode([]); exit; }

$like = "%" . $conn->real_escape_string($q) . "%";
$sql = "SELECT productCode, productName FROM products WHERE productName LIKE ? OR productCode LIKE ? LIMIT 15";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss',$like,$like);
$stmt->execute();
$res = $stmt->get_result();
$out = [];
while($row = $res->fetch_assoc()){
  $label = $row['productCode'] . ' - ' . $row['productName'];
  $out[] = ['value'=>$row['productCode'], 'label'=>$label];
}
echo json_encode($out);
?>
