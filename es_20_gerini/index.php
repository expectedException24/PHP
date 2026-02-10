<?php
$c = new mysqli('localhost','root','', 'classicmodels');
if($c->connect_error) die('DB error');

if($_SERVER['REQUEST_METHOD']==='POST'){
  $cust = intval($_POST['customerNumber'] ?? 0);
  $prod = $c->real_escape_string($_POST['productCode'] ?? '');
  $qty = max(1,intval($_POST['quantity'] ?? 1));
  if(!$cust || !$prod){ echo 'Dati errati'; exit; }
  $r = $c->query("SELECT COALESCE(MAX(orderNumber),1000) AS m FROM orders"); $row = $r->fetch_assoc(); $on = $row['m']+1;
  $c->query("INSERT INTO orders (orderNumber,orderDate,requiredDate,status,customerNumber) VALUES ($on,'".date('Y-m-d')."','".date('Y-m-d',strtotime('+7 days'))."','In Process',$cust)");
  $p = $c->query("SELECT buyPrice FROM products WHERE productCode='$prod' LIMIT 1")->fetch_assoc();
  $price = $p['buyPrice'];
  $ln = $c->query("SELECT COALESCE(MAX(orderLineNumber),0)+1 AS ln FROM orderdetails WHERE orderNumber=$on")->fetch_assoc()['ln'];
  $c->query("INSERT INTO orderdetails (orderNumber,productCode,quantityOrdered,priceEach,orderLineNumber) VALUES ($on,'$prod',$qty,$price,$ln)");
  echo 'OK ordine '.$on; exit;
}

$products = $c->query("SELECT productCode, productName FROM products ORDER BY productName");
$customers = $c->query("SELECT customerNumber, customerName FROM customers ORDER BY customerName");
?>
<!doctype html><html lang="it"><head><meta charset="utf-8"><title>Ordine</title></head><body>
<form method="post">
Cliente:<br>
<select name="customerNumber" required><option value="">--</option><?php while($cu=$customers->fetch_assoc()) echo '<option value="'.htmlspecialchars($cu['customerNumber']).'">'.htmlspecialchars($cu['customerNumber'].' - '.$cu['customerName']).'</option>'; ?></select>
<br>Prodotto:<br>
<select name="productCode" required><option value="">--</option><?php while($p = $products->fetch_assoc()) echo '<option value="'.htmlspecialchars($p['productCode']).'">'.htmlspecialchars($p['productCode'].' - '.$p['productName']).'</option>'; ?></select>
<br>Quantità:<br><input name="quantity" type="number" value="1" min="1"><br><button>Invia</button>
</form></body></html>
