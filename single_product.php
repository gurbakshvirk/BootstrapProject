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

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = "Invalid Product ID!";
    header("Location: index.php");
    exit();
}

$product_id = $_GET['id'];

$sql = "SELECT p.*, c.name AS category_name 
        FROM products p 
        JOIN categories c ON p.category_id = c.id 
        WHERE p.id = $product_id LIMIT 1";

$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    $_SESSION['message'] = "Product not found!";
    header("Location: view_product.php");
    exit();
}




if (isset($_POST["addtocartbtn"])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $qty = (int)$_POST['qty'];

    //product already exists in the cart
    $check_sql = "SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        //Product exists  update quantity
        $row = mysqli_fetch_assoc($check_result);
        $existing_qty = $row['quantity'];
        $new_qty = $existing_qty + $qty;

        $update_sql = "UPDATE cart SET quantity = $new_qty WHERE user_id = $user_id AND product_id = $product_id";
        if (mysqli_query($conn, $update_sql)) {
            $_SESSION['message'] = "Product quantity updated in cart!";
        } else {
            $_SESSION['message'] = "Failed to update cart.";
        }

    } else {
        //  Product not in cart insert new row
        $insert_sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $qty)";
        if (mysqli_query($conn, $insert_sql)) {
            $_SESSION['message'] = "Product added to cart!";
        } else {
            $_SESSION['message'] = "Failed to add to cart.";
        }
    }

    //Redirect back to the same product page
    header("Location: single_product.php?id=" . $product_id);
    exit();
}







if(isset($_POST["wishlistbtn"])){
  
// user id
if (isset($_SESSION['user_id'])) {
    //  loged in
    $user_id = $_SESSION['user_id'];
} else {
    // not loged in
    header("Location: login.php");
    exit();
}
$sql = "SELECT * FROM wishlist WHERE user_id = $user_id AND product_id = $product_id";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    echo "✅ Product is already in your wishlist.";
} else {
    $insert_sql = "INSERT INTO wishlist (user_id, product_id, added_on) VALUES ($user_id, $product_id, NOW())";
    if (mysqli_query($conn, $insert_sql)) {
        echo "Product added to your wishlist!";
    } else {
        echo "Failed to add to wishlist.";
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($product['name']); ?> | ClassicCave</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .product-img {
      width: 100%;
      max-height: 500px;
      object-fit: contain;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
    }
    .price-box {
      font-size: 1.4rem;
      margin-bottom: 10px;
    }
    .price-box del {
      color: #888;
      margin-left: 10px;
    }
    .btn-buy {
      width: 100%;
      font-size: 1.1rem;
    }
    .badge {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<?php
include'indexnav.php';
?>




<div class="container py-5 mt-5 pt-5">
  <?php if(isset($_SESSION['message'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>
  <a href="index.php" class="btn btn-outline-secondary mb-4">← Back to Products</a>

  <div class="row g-4">
    <!-- Left: Image -->
    <div class="col-md-6">
      <img src="uploads/<?= $product['images']; ?>" alt="<?= $product['name']; ?>" class="product-img">
    </div>

    <!-- Right: Details -->
    <div class="col-md-6">
      <h2><?= $product['name']; ?></h2>
      <p class="text-muted">Category: <?= $product['category_name']; ?></p>

      <div class="price-box">
        ₹<?= $product['selling_price']; ?>
        <del>₹<?= $product['original_price']; ?></del>
      </div>
      
      <p><strong>Quantity:</strong> <?= $product['qty']; ?></p>
      <p>
        <strong>Status:</strong>
        <?= $product['status'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'; ?>
      </p>
      <p>
        <strong>Trending:</strong>
        <?= $product['trending'] ? '<span class="badge bg-info text-dark">Yes</span>' : 'No'; ?>
      </p>

      <hr>
      <p><strong>Short Description:</strong><br><?= $product['small_description']; ?></p>
      <p><strong>Full Description:</strong><br><?= nl2br($product['description']); ?></p>

      <button class="btn btn-primary btn-buy mt-3">Buy Now</button>
      <form method="POST" action="">
  <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
  <input type="hidden" name="qty" value="1"> <!-- default quantity -->
  <button type="submit" name="addtocartbtn" class="btn btn-success btn-buy mt-3">Add to Cart</button>
</form>
<form action="add_to_wishlist.php" method="POST">
    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
    <input type="hidden" name="from" value="single_product.php?id=<?= $product['id']; ?>">
    <button type="submit" name="wishlistbtn" class="btn btn-outline-danger">❤️ Add to Wishlist</button>
</form>

    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
