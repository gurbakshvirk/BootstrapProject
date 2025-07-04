<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";

$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Please log in to view your cart.";
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.*, products.name, products.images, products.selling_price 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = $user_id";

$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart | ClassicCave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Your Shopping Cart</h2>

    <?php if (mysqli_num_rows($query) > 0): ?>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Subtotal (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                while ($row = mysqli_fetch_assoc($query)): 
                    $subtotal = $row['selling_price'] * $row['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><img src="uploads/<?= htmlspecialchars($row['images']); ?>" alt="<?= htmlspecialchars($row['name']); ?>" width="70"></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= $row['selling_price']; ?></td>
                    <td><?= $row['quantity']; ?></td>
                    <td><?= $subtotal; ?></td>
                </tr>
                <?php endwhile; ?>
                <tr class="table-secondary fw-bold">
                    <td colspan="4">Total</td>
                    <td>₹<?= $total; ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-warning">Your cart is empty.</p>
    <?php endif; ?>

    <a href="products.php" class="btn btn-primary mt-3">Continue Shopping</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
