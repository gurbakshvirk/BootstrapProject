<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";

$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Get the product ID from URL
$product_id = mysqli_real_escape_string($conn, $_GET['id']);

// 2. Get the image name from database before deleting the product
$get_image_query = "SELECT images FROM products WHERE id = '$product_id'";
$image_result = mysqli_query($conn, $get_image_query);

if ($image_result && mysqli_num_rows($image_result) > 0) {
    $image_data = mysqli_fetch_assoc($image_result);
    $image_filename = $image_data['images'];

    // 3. Delete the product from the database
    $delete_query = "DELETE FROM products WHERE id = '$product_id'";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        // 4. If product is deleted, also delete the image file
        $image_path = "uploads/" . $image_filename;
        if (file_exists($image_path)) {
            unlink($image_path); // deletes the image file
        }

        $_SESSION['message'] = "Product deleted successfully!";
    } else {
        $_SESSION['message'] = "Product deletion failed!";
    }
} else {
    $_SESSION['message'] = "Product not found!";
}

// 5. Redirect back
header("Location: added_products.php");
exit();
?>
