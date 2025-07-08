<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ccbs";
$conn = new mysqli($hostname, $username, $password, $dbname);

if (isset($_GET['id']) && isset($_GET['product_id'])) {
    $id = $_GET['id'];
    $product_id = $_GET['product_id'];

    $image_query = "SELECT image_path FROM product_images WHERE id = '$id'";
    $image_result = mysqli_query($conn, $image_query);
    $image_data = mysqli_fetch_assoc($image_result);
    if ($image_data && file_exists("uploads/" . $image_data['image_path'])) {
        unlink("uploads/" . $image_data['image_path']);
    }

    $delete_query = "DELETE FROM product_images WHERE id = '$id'";
    mysqli_query($conn, $delete_query);

    $_SESSION['message'] = "Image deleted successfully.";
    header("Location: edit_product.php?id=$product_id");
    exit();
}
?>
