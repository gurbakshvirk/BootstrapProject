<?php
$conn = mysqli_connect("localhost", "root", "", "CCBS");

if (!isset($_GET['order_id'])) {
    die("Invalid request.");
}

$order_id = intval($_GET['order_id']);

// Fetch order
$order_sql = "SELECT * FROM orders WHERE id = $order_id";
$order = mysqli_fetch_assoc(mysqli_query($conn, $order_sql));

// Fetch items
$item_sql = "SELECT oi.*, p.name, p.images 
             FROM order_items oi
             JOIN products p ON oi.product_id = p.id
             WHERE oi.order_id = $order_id";
$items = mysqli_query($conn, $item_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order #<?= $order_id ?> Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Order #<?= $order_id ?> - <?= ucfirst($order['order_status']) ?></h3>
    <p><strong>Name:</strong> <?= $order['name'] ?></p>
    <p><strong>Phone:</strong> <?= $order['phone'] ?></p>
    <p><strong>Address:</strong> <?= $order['address'] ?>, <?= $order['city'] ?> - <?= $order['zip'] ?></p>
    <p><strong>Payment:</strong> <?= $order['payment_method'] ?> (<?= ucfirst($order['payment_status']) ?>)</p>
    <p><strong>Total:</strong> ₹<?= $order['total_price'] ?></p>

    <h5 class="mt-4">Items</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = mysqli_fetch_assoc($items)) { ?>
                <tr>
                    <td><img src="uploads/<?= $item['images'] ?>" width="50"></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>₹<?= $item['price'] ?></td>
                    <td>₹<?= $item['price'] * $item['quantity'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="admin_orders.php" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
</body>
</html>
