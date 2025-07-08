<?php
session_start();

// ✅ Database Connection
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ✅ Check if user is logged in and data is sent
if (isset($_SESSION['user_id']) && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // ✅ Minimum quantity is 1
    if ($quantity < 1) {
        $quantity = 1;
    }

    // ✅ Get stock quantity from products table
    $stock_sql = "SELECT qty FROM products WHERE id = $product_id";
    $stock_result = mysqli_query($conn, $stock_sql);

    if ($stock_result && mysqli_num_rows($stock_result) > 0) {
        $stock_row = mysqli_fetch_assoc($stock_result);
        $available_stock = (int)$stock_row['qty'];

        // ✅ Limit cart quantity to available stock
        if ($quantity > $available_stock) {
            $quantity = $available_stock;
        }

        // ✅ Update quantity in cart
        $update_sql = "UPDATE cart SET quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id";
        if (mysqli_query($conn, $update_sql)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }

} else {
    echo "invalid";
}
?>
