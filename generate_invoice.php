<?php
$conn = mysqli_connect("localhost", "root", "", "CCBS");

if (!isset($_GET['order_id'])) {
    die("Invalid request.");
}

$order_id = intval($_GET['order_id']);

// Fetch order
$order_sql = "SELECT * FROM orders WHERE id = $order_id";
$order = mysqli_fetch_assoc(mysqli_query($conn, $order_sql));

// Fetch order items
$item_sql = "SELECT oi.*, p.name 
             FROM order_items oi
             JOIN products p ON oi.product_id = p.id
             WHERE oi.order_id = $order_id";
$items = mysqli_query($conn, $item_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice #<?= $order_id ?> | ClassicCave</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px auto;
            max-width: 800px;
            color: #333;
        }
        .invoice-box {
            border: 1px solid #eee;
            padding: 30px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-height: 80px;
        }
        .store-name {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
            color: #000;
        }
        .invoice-header {
            margin-bottom: 20px;
        }
        .invoice-header div {
            margin-bottom: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: center;
        }
        .total-row {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }
        .print-btn {
            margin-top: 30px;
            text-align: center;
        }
        .print-btn button,
        .print-btn a {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #0d6efd;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px;
        }
        .print-btn a:hover,
        .print-btn button:hover {
            background-color: #0b5ed7;
        }
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="logo">
        <img src="assets/classic2.png" alt="ClassicCave Logo">
    </div>
    <div class="store-name">ClassicCave Clothing</div>
    <p style="text-align: center;">www.classiccave.com</p>

    <hr>

    <div class="invoice-header">
        <div><strong>Invoice ID:</strong> <?= $order_id ?></div>
        <div><strong>Date:</strong> <?= date('d M Y', strtotime($order['created_at'])) ?></div>
        <div><strong>Customer:</strong> <?= htmlspecialchars($order['name']) ?></div>
        <div><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></div>
        <div><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?>, <?= $order['city'] ?> - <?= $order['zip'] ?></div>
        <div><strong>Payment Method:</strong> <?= $order['payment_method'] ?> (<?= $order['payment_status'] ?>)</div>
        <div><strong>Order Status:</strong> <?= ucfirst($order['order_status']) ?></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price (₹)</th>
                <th>Subtotal (₹)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while ($item = mysqli_fetch_assoc($items)) {
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
                ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['price'], 2) ?></td>
                    <td><?= number_format($subtotal, 2) ?></td>
                </tr>
            <?php } ?>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Grand Total</td>
                <td>₹<?= number_format($total, 2) ?></td>
            </tr>
        </tbody>
    </table>

    <div class="print-btn">
        <a href="download_invoice.php?order_id=<?= $order_id ?>">⬇️ Download PDF</a>
        <button onclick="window.print()">🖨️ Print Invoice</button>
    </div>

    <div class="footer">
        Thank you for shopping with ClassicCave Clothing!<br>
        For help, contact support@classiccave.com
    </div>
</div>

</body>
</html>
