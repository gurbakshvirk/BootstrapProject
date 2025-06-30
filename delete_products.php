<?php



session_start();
// if (!isset($_SESSION['status'])) {
//     $_SESSION['status'] === '0'; // or any default value you want
// }

$hostname = "localhost";
$username = "root";
$password = "";
$dbname =  "ccbs";


$conn = new mysqli($hostname, $username, $password , $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];


$sql = "SELECT * FROM categories WHERE id = '$id' ";


if(isset($_POST['delete_category'])){
    $delete_query = "DELETE FROM categories WHERE id = '$id'";
    if(mysqli_query($conn,$delete_query)){

    $_SESSION['message'] = "Category Deleted Sucessfully!";
    header("Location: added_categories.php");
    exit();
}
else {
        $_SESSION['message'] = "Delete failed!";
    }
}