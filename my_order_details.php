<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "CCBS");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['order_id'])) {
    die("Invalid order ID.");
}

$order_id = intval($_GET['order_id']);
$user_id = $_SESSION['user_id'];

// Fetch order (only if belongs to this user)
$order_sql = "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id";
$order_result = mysqli_query($conn, $order_sql);
$order = mysqli_fetch_assoc($order_result);

if (!$order) {
    die("Order not found.");
}

// Fetch order items
$item_sql = "SELECT oi.*, p.name, p.images 
             FROM order_items oi 
             JOIN products p ON oi.product_id = p.id 
             WHERE oi.order_id = $order_id";
$items = mysqli_query($conn, $item_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order #<?= $order_id ?> Details | ClassicCave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'indexnav.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Order #<?= $order_id ?> Details</h2>

    <div class="mb-4">
        <h5>Customer Info:</h5>
        <p><strong>Name:</strong> <?= htmlspecialchars($order['name']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?>, <?= $order['city'] ?> - <?= $order['zip'] ?></p>
        <p><strong>Order Date:</strong> <?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></p>
        <p><strong>Payment:</strong> <?= ucfirst($order['payment_method']) ?> (<?= ucfirst($order['payment_status']) ?>)</p>
        <p><strong>Status:</strong> <?= ucfirst($order['order_status']) ?></p>
    </div>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Image</th>
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
                <td><img src="uploads/<?= $item['images'] ?>" width="60"></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price'], 2) ?></td>
                <td><?= number_format($subtotal, 2) ?></td>
            </tr>
        <?php } ?>
            <tr class="table-secondary fw-bold">
                <td colspan="4" class="text-end">Grand Total</td>
                <td>₹<?= number_format($total, 2) ?></td>
            </tr>
        </tbody>
    </table>

    <?php if ($order['order_status'] == 'approved'): ?>
        <a href="download_invoice.php?order_id=<?= $order_id ?>" class="btn btn-success mt-3">⬇️ Download Invoice</a>
    <?php endif; ?>
    <?php if ($order['order_status'] == 'pending'): ?>
    <a href="cancel_order.php?order_id=<?= $order_id ?>" class="btn btn-danger mt-3"
       onclick="return confirm('Are you sure you want to cancel this order?');">❌ Cancel Order</a>
<?php endif; ?>


    <a href="my_orders.php" class="btn btn-secondary mt-3">← Back to My Orders</a>
</div>
</body>
</html>
