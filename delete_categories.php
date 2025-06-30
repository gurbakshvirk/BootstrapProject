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
//  $cate_query_run = mysqli_query($conn, $cate_query);


//  if(isset($_POST['delete_category'])){
//     $category_id = $_POST['category_id'];
//     $delete_query = "DELETE FROM categories WHERE id = ?";
//     $del = $conn->prepare($delete_query);
//     $_SESSION['message'] = "Category deleted successfully.";
//  }
//     if($del->execute()){
//         $_SESSION['message'] = "Category deleted successfully.";
//     } else {
//         $_SESSION['message'] = "Error deleting category: " . $del->error;
//     }

 if (isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];
    
    // Prepare the SQL statement to delete the category
    $delete_query = "DELETE FROM categories WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $category_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Category deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting category: " . $stmt->error;
    }
    
    $stmt->close();
    header("Location: categories.php");
    exit(); 
} else {
    $_SESSION['message'] = "No category selected for deletion.";
    header("Location: categories.php");
    exit();
}
$conn->close();
?>

