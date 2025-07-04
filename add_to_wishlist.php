<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";

$conn = new mysqli($hostname, $username, $password, $dbname);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
    $_SESSION['message'] = "Invalid product ID.";
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$redirect_page = isset($_POST['from']) ? $_POST['from'] : "index.php";

// Check if already in wishlist
$check_sql = "SELECT * FROM wishlist WHERE user_id = $user_id AND product_id = $product_id";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    $_SESSION['message'] = "✅ Product is already in your wishlist.";
} else {
    $insert_sql = "INSERT INTO wishlist (user_id, product_id, added_on) VALUES ($user_id, $product_id, NOW())";
    if (mysqli_query($conn, $insert_sql)) {
        $_SESSION['message'] = " Product added to your wishlist!";
    } else {
        $_SESSION['message'] = "Failed to add to wishlist.";
    }
}

header("Location: $redirect_page");
exit();
?>
