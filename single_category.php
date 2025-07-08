<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname =  "ccbs";


$conn = new mysqli($hostname, $username, $password , $dbname);
$sql ="select * from products";
$result = mysqli_query($conn, $sql);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = "Invalid Category ID!";
    header("Location: index.php");
    exit();
}
$cat_id = $_GET['id'];

// $sql = "SELECT FROM CATEGORIES WHERE id = $cat_id LIMIT 1";
$sql = "SELECT p.*, c.name AS category_name 
        FROM products p 
        JOIN categories c ON p.category_id = c.id 
        WHERE c.id = $cat_id";

$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
if (!$product) {
    $_SESSION['message'] = "Category not found!";
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    include 'indexnav.php'
    ?>
    
    <div class="row gy-4">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-md-4 mb-4">
          <div class="card product-card h-100 shadow-sm border-0">
            <img src="uploads/<?= $row['images']; ?>" class="card-img-top" alt="<?= $row['name']; ?>">
            <div class="card-body">
              <h5 class="card-title"><?= $row['name']; ?></h5>
              <p class="text-muted mb-1">
                ₹<?= $row['selling_price']; ?>
                <del class="text-secondary small">₹<?= $row['original_price']; ?></del>
              </p>
              <a href="single_product.php?id=<?= $row['id']; ?>" class="btn btn-dark btn-sm mt-3">View Product</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    
</body>
</html>