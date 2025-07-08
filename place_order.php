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

$userid = $_SESSION['user_id'];

// Get data from form
$name     = $_POST['name'] ?? '';
$phone    = $_POST['phone'] ?? '';
$address  = $_POST['address'] ?? '';
$city     = $_POST['city'] ?? '';
$zip      = $_POST['zip'] ?? '';
$payment  = $_POST['payment_method'] ?? 'COD';

if (empty($name) || empty($phone) || empty($address) || empty($city) || empty($zip)) {
    die("All fields are required.");
}

// Step 1: Fetch cart items
$cart_sql = "SELECT c.product_id, c.quantity, p.selling_price, p.qty AS stock 
             FROM cart c 
             JOIN products p ON c.product_id = p.id 
             WHERE c.user_id = $userid";
$cart_result = mysqli_query($conn, $cart_sql);

if (mysqli_num_rows($cart_result) < 1) {
    die("Cart is empty!");
}

// Step 2: Validate stock
while ($item = mysqli_fetch_assoc($cart_result)) {
    if ($item['quantity'] > $item['stock']) {
        die("Product ID {$item['product_id']} is out of stock!");
    }
}

// Step 3: Recalculate total
$total_price = 0;
$cart_result = mysqli_query($conn, $cart_sql); // rerun query
while ($item = mysqli_fetch_assoc($cart_result)) {
    $total_price += $item['selling_price'] * $item['quantity'];
}

// Step 4: Insert into orders table
$order_sql = "INSERT INTO orders (user_id, name, phone, address, city, zip, payment_method, payment_status, order_status, total_price, created_at)
              VALUES ('$userid', '$name', '$phone', '$address', '$city', '$zip', '$payment', 'pending', 'pending', '$total_price', NOW())";

$order_result = mysqli_query($conn, $order_sql);
if (!$order_result) {
    die("Order failed: " . mysqli_error($conn));
}

$order_id = mysqli_insert_id($conn);

// Step 5: Insert into order_items and update product stock
$cart_result = mysqli_query($conn, $cart_sql); // rerun again
while ($item = mysqli_fetch_assoc($cart_result)) {
    $pid   = $item['product_id'];
    $qty   = $item['quantity'];
    $price = $item['selling_price'];

    // Insert into order_items
    mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price)
                         VALUES ('$order_id', '$pid', '$qty', '$price')");

    // Update stock
    mysqli_query($conn, "UPDATE products SET qty = qty - $qty WHERE id = $pid");
}

// Step 6: Clear cart
mysqli_query($conn, "DELETE FROM cart WHERE user_id = $userid");

// Redirect to order confirmation
header("Location: order_confirmation.php?order_id=$order_id");
exit;
?>
