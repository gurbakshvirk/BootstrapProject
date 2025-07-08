<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname   = "CCBS";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get order ID from URL
if (!isset($_GET['order_id'])) {
    echo "Invalid request.";
    exit();
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];

// Fetch order
$order_sql = "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id LIMIT 1";
$order_result = mysqli_query($conn, $order_sql);

if (mysqli_num_rows($order_result) == 0) {
    echo "Order not found.";
    exit();
}

$order = mysqli_fetch_assoc($order_result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation | ClassicCave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'indexnav.php'; ?>

<div class="container mt-5">
    <div class="alert alert-success">
        <h4 class="alert-heading">Thank you for your order!</h4>
        <p>Your order has been placed successfully. Below are your order details:</p>
        <hr>
        <p><strong>Order ID:</strong> <?= $order['id'] ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($order['name']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?>, <?= htmlspecialchars($order['city']) ?> - <?= htmlspecialchars($order['zip']) ?></p>
        <p><strong>Total Amount:</strong> ₹<?= $order['total_price'] ?></p>
        <p><strong>Payment Method:</strong> <?= $order['payment_method'] ?></p>
        <p><strong>Order Status:</strong> <?= ucfirst($order['order_status']) ?></p>
    </div>

    <a href="index.php" class="btn btn-primary">Back to Home</a>
</div>

</body>
</html>
