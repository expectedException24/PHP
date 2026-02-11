<?php
$conn = new mysqli('localhost', 'root', '', 'classicmodels');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerNumber = intval($_POST['customerNumber'] ?? 0);
    $productCode = $conn->real_escape_string($_POST['productCode'] ?? '');
    $quantity = max(1, intval($_POST['quantity'] ?? 1));
    
    if (!$customerNumber || $quantity < 1) {
        echo 'Dati mancanti o non validi.';
        exit;
    }

    $res = $conn->query("SELECT COALESCE(MAX(orderNumber), 1000) AS maxNum FROM orders");
    $row = $res->fetch_assoc();
    $newOrderNumber = $row['maxNum'] + 1;

    $orderDate = date('Y-m-d');
    $requiredDate = date('Y-m-d', strtotime('+7 days'));
    $status = 'In Process';

    $conn->query("INSERT INTO orders (orderNumber, orderDate, requiredDate, status, customerNumber) VALUES ($newOrderNumber, '$orderDate', '$requiredDate', '$status', $customerNumber)");
    
    $prodRes = $conn->query("SELECT buyPrice FROM products WHERE productCode = '$productCode' LIMIT 1");
    $prodRow = $prodRes->fetch_assoc();
    $priceEach = $prodRow ? $prodRow['buyPrice'] : 0;

    $lineRes = $conn->query("SELECT COALESCE(MAX(orderLineNumber), 0) + 1 AS lineNum FROM orderdetails WHERE orderNumber = $newOrderNumber");
    $lineRow = $lineRes->fetch_assoc();
    $lineNumber = $lineRow['lineNum'];

    $conn->query("INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) VALUES ($newOrderNumber, '$productCode', $quantity, $priceEach, $lineNumber)");
    
    echo '<div style="padding: 20px; background: #d4edda; color: #155724; border-radius: 5px; margin: 20px 0; text-align: center;">
            <h3>✓ Ordine creato con successo</h3>
            <p>Numero ordine: <strong>' . $newOrderNumber . '</strong></p>
            <a href="' . $_SERVER['PHP_SELF'] . '" style="color: #155724; text-decoration: none; font-weight: bold;">← Nuovo ordine</a>
          </div>';
    exit;
}

$productsResult = $conn->query("SELECT productCode, productName FROM products ORDER BY productName LIMIT 1000");
$customersResult = $conn->query("SELECT customerNumber, customerName FROM customers ORDER BY customerName LIMIT 1000");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Ordine - Gestione Ordini</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        select,
        input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        select:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23667eea' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 40px;
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        button:active {
            transform: translateY(0);
        }

        .form-info {
            background: #f5f5f5;
            border-left: 4px solid #667eea;
            padding: 12px 15px;
            border-radius: 4px;
            margin-top: 20px;
            font-size: 13px;
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nuovo Ordine</h1>
            <p>Compila il modulo per aggiungere un nuovo ordine</p>
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label for="customerNumber">Cliente *</label>
                <select id="customerNumber" name="customerNumber" required>
                    <option value="">-- Seleziona un cliente --</option>
                    <?php while ($customer = $customersResult->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($customer['customerNumber']); ?>">
                            <?php echo htmlspecialchars($customer['customerNumber'] . ' - ' . $customer['customerName']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="productCode">Prodotto *</label>
                <select id="productCode" name="productCode" required>
                    <option value="">-- Seleziona un prodotto --</option>
                    <?php while ($product = $productsResult->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($product['productCode']); ?>">
                            <?php echo htmlspecialchars($product['productCode'] . ' - ' . $product['productName']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantità *</label>
                <input id="quantity" type="number" name="quantity" value="1" min="1" required>
            </div>

            <button type="submit">Crea Ordine</button>

            <div class="form-info">
                <strong>ℹ Informazioni:</strong><br>
                La data di ordine è automaticamente impostata a oggi. La data di consegna è impostata a 7 giorni da oggi.
                <a href="..\es_19_gerini\index.php">Clicca qui per vedere gli ordini</a>
            </div>
        </form>
    </div>
</body>
</html>
