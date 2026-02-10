<?php
require 'connection.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
  header('Location: index.php'); exit;
}

$customerNumber = isset($_POST['customerNumber']) ? intval($_POST['customerNumber']) : 0;
$productCode = isset($_POST['productCode']) ? $_POST['productCode'] : '';
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

if(!$customerNumber || $quantity < 1){
  echo 'Dati mancanti o non validi.'; exit;
}
$res = $conn->query("SELECT COALESCE(MAX(orderNumber),1000) AS maxn FROM orders");
$row = $res->fetch_assoc();
$newOrder = $row['maxn'] + 1;

$orderDate = date('Y-m-d');
$requiredDate = date('Y-m-d', strtotime('+7 days'));
$status = 'In Process';

$conn->begin_transaction();
try{
  $stmt = $conn->prepare("INSERT INTO orders (orderNumber, orderDate, requiredDate, status, customerNumber) VALUES (?,?,?,?,?)");
  $stmt->bind_param('isssi',$newOrder,$orderDate,$requiredDate,$status,$customerNumber);
  $stmt->execute();

  $pstmt = $conn->prepare("SELECT buyPrice FROM products WHERE productCode = ? LIMIT 1");
  $pstmt->bind_param('s',$productCode);
  $pstmt->execute();
  $pres = $pstmt->get_result();
  $prow = $pres->fetch_assoc();
   $priceEach = $prow ? $prow['buyPrice'] : 0;

  $lstmt = $conn->prepare("SELECT COALESCE(MAX(orderLineNumber),0) + 1 AS linen FROM orderdetails WHERE orderNumber = ?");
  $lstmt->bind_param('i',$newOrder);
  $lstmt->execute();
  $lres = $lstmt->get_result();
  $linen = $lres->fetch_assoc()['linen'];

  $odstmt = $conn->prepare("INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) VALUES (?,?,?,?,?)");
  $odstmt->bind_param('issdi',$newOrder,$productCode,$quantity,$priceEach,$linen);
  $odstmt->execute();

  $conn->commit();
  echo 'Ordine inserito con successo. OrderNumber: ' . $newOrder;
}catch(Exception $e){
  $conn->rollback();
  echo 'Errore inserimento ordine: ' . $e->getMessage();
}

?>
