<?php
session_start();

// ✅ Connect to Database
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ✅ Check if user is logged in and product_id is provided
if (isset($_SESSION['user_id']) && isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = (int)$_POST['product_id'];

    // ✅ Delete item from cart
    $delete_sql = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    if (mysqli_query($conn, $delete_sql)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid";
}
?>
