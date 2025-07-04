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

// Step 1: Get the category ID from the URL
if (!isset($_GET['id'])) {
    $_SESSION['message'] = "No category ID provided!";
    header("Location: add_categories.php");
    exit();
}

$category_id = mysqli_real_escape_string($conn, $_GET['id']);

// Step 2: Get the image filename from the DB
$get_image_query = "SELECT image FROM categories WHERE id = '$category_id'";
$image_result = mysqli_query($conn, $get_image_query);

if ($image_result && mysqli_num_rows($image_result) > 0) {
    $image_data = mysqli_fetch_assoc($image_result);
    $image_filename = $image_data['image'];

    // Step 3: Delete the record from DB
    $delete_query = "DELETE FROM categories WHERE id = '$category_id'";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        // Step 4: Delete the image from the folder
        $image_path = "catuploads/" . $image_filename;
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the file
        }

        $_SESSION['message'] = "Category deleted successfully!";
    } else {
        $_SESSION['message'] = "Failed to delete category!";
    }

} else {
    $_SESSION['message'] = "Category not found!";
}

header("Location: added_categories.php");
exit();
?>
