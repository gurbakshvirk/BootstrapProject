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

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.id, products.name, products.images, products.selling_price 
        FROM wishlist 
        JOIN products ON wishlist.product_id = products.id 
        WHERE wishlist.user_id = $user_id";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Wishlist | ClassicCave</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9f9f9;
      padding: 30px;
      font-family: Arial, sans-serif;
    }
    .product-card {
      width: 220px;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px;
      background: #fff;
      margin: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .product-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 6px;
    }
    .wishlist-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .remove-btn {
      margin-top: 10px;
      display: inline-block;
      padding: 6px 10px;
      background-color: #dc3545;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<h2>Your Wishlist</h2>

<?php if (isset($_SESSION['message'])): ?>
  <div class="alert alert-info"><?= $_SESSION['message']; ?></div>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<div class="wishlist-container">
<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='product-card'>";
        echo "<img src='uploads/" . $row['images'] . "' alt='" . $row['name'] . "'>";
        echo "<h5>" . $row['name'] . "</h5>";
        echo "<p>Price: ₹" . $row['selling_price'] . "</p>";
        echo "<a href='remove_from_wishlist.php?id=" . $row['id'] . "' class='remove-btn'>Remove</a>";
        echo "</div>";
    }
} else {
    echo "<p>You have no items in your wishlist.</p>";
}
?>
</div>

</body>
</html>
