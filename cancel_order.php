<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "CCBS");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$order_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'] ?? 0;

// Check if the order belongs to the logged-in user and is still pending
$sql = "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id AND order_status = 'pending'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $update_sql = "UPDATE orders SET order_status = 'cancelled' WHERE id = $order_id";
    mysqli_query($conn, $update_sql);
}

header("Location: my_orders.php");
exit;
?>