<!-- Description: This file displays the products added to the cart by the user -->
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
// while ($row = mysqli_fetch_assoc($result)) {
//     $_SESSION['id'] = $row['id'];
//     $_SESSION['category_id'] = $row['category_id'];
//     $_SESSION['name'] = $row['name'];
//     $_SESSION['slug'] = $row['slug'];
//     $_SESSION['small_description'] = $row['small_description'];
//     $_SESSION['description'] = $row['description'];
//     $_SESSION['original_price'] = $row['original_price'];
//     $_SESSION['selling_price'] = $row['selling_price'];
//     $_SESSION['images'] = $row['images'];
//     $_SESSION['qty'] = $row['qty'];
//     $_SESSION['status'] = $row['status'];
//     $_SESSION['trending'] = $row['trending'];
//     $_SESSION['meta_title'] = $row['meta_title'];
//     $_SESSION['meta_description'] = $row['meta_description'];
//     $_SESSION['meta_keywords'] = $row['meta_keywords'];
    
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>ClassicCave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Miniver&family=Poppins&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
  <div class="container-fluid ">
    <a class="navbar-brand fs-6 d-flex align-items-center" href="index.php">
 <img src="assets/classic2.png" style="height: 8vh; width: 8vh;">
  <span style="display:inline-block; width:auto; height:auto; margin-left: 5px;">ClassicCave</span>
</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5 text-end">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>
<?php if (isset($_SESSION['user_id'])): ?>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <?=($_SESSION['user_name']); ?>
    </a>
    <ul class="dropdown-menu">
      <!-- <li><a class="dropdown-item" href="profile.php">Profile</a></li> -->
      <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <li><a class="dropdown-item" href="admin_dashboard.php">Admin Panel</a></li>
      <?php endif; ?>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
    </ul>
  </li>
<?php else: ?>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Support
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="login.php">Sign In</a></li>
      <li><a class="dropdown-item" href="signin.php">Register</a></li>
      <li><a class="dropdown-item" href="contact.php">Contact Us</a></li>
    </ul>
  </li>
<?php endif; ?>

       
      </ul>
    </div>
  </div>
</nav>
</header>
<div class="container mt-5 pt-5 ">
    <h1>All Products</h1>

    
      <div class="row mt-5 " style="display: flex; flex-wrap: wrap; justify-content: center;">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
  <div class="col-md-4 mb-4">
    <div class="card h-100">
      <img src="uploads/<?= $row['images']; ?>" alt="Product Image" class="card-img-top" style="height: 70vh; object-fit: cover;">
      <div class="card-body">
        <h3 class="card-title"><?= $row['name']; ?></h3>
        <div class="container"></div>
        <!-- <p class="card-text">Category ID: <?= $row['category_id']; ?></p> -->
        <!-- <p class="card-text">Product ID: <?= $row['id']; ?></p> -->
        <!-- <p class="card-text">Slug: <?= $row['slug']; ?></p> -->
        <p class="card-text">Small Description: <?= $row['small_description']; ?></p>
        <p class="card-text">Description: <?= $row['description']; ?></p>
        <p class="card-text">Original Price: ₹<?= $row['original_price']; ?></p>
        <p class="card-text">Selling Price: ₹<?= $row['selling_price']; ?></p>
        <p class="card-text">Quantity: <?= $row['qty']; ?></p>
        <!-- <p class="card-text">Status: <?= $row['status'] ? 'Active' : 'Inactive'; ?></p> -->
        <!-- <p class="card-text">Trending: <?= $row['trending'] ? 'Yes' : 'No'; ?></p> -->
        <!-- <p class="card-text">Meta Title: <?= $row['meta_title']; ?></p> -->
        <!-- <p class="card-text">Meta Description: <?= $row['meta_description']; ?></p> -->
        <!-- <p class="card-text">Meta Keywords: <?= $row['meta_keywords']; ?></p> -->
        <div class="d-flex justify-content-between mt-3">
          <!-- <a href="#" class="btn btn-primary btn-sm">See Product</a>
          <a href="#" class="btn btn-warning btn-sm">Edit Product</a>
          <a href="#" class="btn btn-danger btn-sm">Delete Product</a> -->
          <a href="#" class="btn btn-primary btn-sm">See Product</a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
</div>

     

</div>
    

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>