<?php
session_start();
$conn = new mysqli("localhost", "root", "", "CCBS");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

mysqli_query($conn, "DELETE FROM wishlist WHERE user_id = $user_id AND product_id = $product_id");

$_SESSION['message'] = "❌ Product removed from wishlist.";
header("Location: wishlist.php");
exit();
?>
