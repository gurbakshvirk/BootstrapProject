<!-- To view single product as a user -->
<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname =  "ccbs";


$conn = new mysqli($hostname, $username, $password , $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];

$sql  = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

// Check if the product ID is set in the URL
if (!isset($_GET['id'])) {
    $_SESSION['message'] = "Product ID not specified!";
    header("Location: added_products.php");
    exit();
}




if (mysqli_num_rows($result) !== 1) {
    $_SESSION['message'] = "Product not found!";
    header("Location: added_products.php");
    exit();
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/view_single_product.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-6">

        <?php if($col = mysqli_fetch_assoc($result)) { ?>
                <img src="<?= $col['image'] ?>" alt="<?= $col['name'] ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h1><?= $col['name'] ?></h1>
                <p><?= $col['description'] ?></p>
                <h3>Price: $<?= $col['price'] ?></h3>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $col['id'] ?>">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
        <div class="mt-5">
            <h2>Product Details</h2>
            <p><strong>Category:</strong> <?= $product['category'] ?></p>
            <p><strong>Stock:</strong> <?= $product['stock'] ?> available</p>
            <p><strong>Added on:</strong> <?= date('Y-m-d', strtotime($product['created_at'])) ?></p>
            <p><strong>Last updated:</strong> <?= date('Y-m-d', strtotime($product['updated_at'])) ?></p>
        </div>
    </div>
    <?php } ?>
    <footer class="text-center mt-5">
        <p>&copy; 2023 ClassicCave. All rights reserved.</p>
    </footer>
</body>
</html>
<?php
// C  connection
$conn->close();
?>



