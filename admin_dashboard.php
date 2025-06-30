<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname =  "ccbs";


$conn = new mysqli($hostname, $username, $password , $dbname);
$sql ="select * from products where trending ='1'";
$result = mysqli_query($conn, $sql);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql2 ="select * from categories where popular ='1'";
$result2 = mysqli_query($conn, $sql2);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
  <div class="container-fluid ">
    <a class="navbar-brand fs-6 d-flex align-items-center" href="admin_dashboard.php">
  <img src="assets/classic2.png" style="height: 8vh; width: 8vh;">
  <span style="display:inline-block; width:auto; height:auto; margin-left: 5px;">ClassicCave</span>
</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5 text-end">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">User Panel</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="products.php">All Products</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li> -->
<?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?>
  <li class="nav-item">
    <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
  </li>
  <!-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Products
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="add_product.php">Add Product</a></li>
      <li><a class="dropdown-item" href="added_products.php">View Products</a></li>
    </ul>
  </li> -->
  <!-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Categories</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="add_categories.php">Add Category</a></li>
      <li><a class="dropdown-item" href="added_categories.php">View Categories</a></li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="orders.php">Orders Management</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="messages.php">Customer Messages</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="users.php">User Management</a>
  </li> -->
  <!-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Reports</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="sales_report.php">Sales Reports</a></li>
      <li><a class="dropdown-item" href="stock_alerts.php">Stock Alerts</a></li>
      <li><a class="dropdown-item" href="performance.php">Performance Analytics</a></li>
    </ul>
  </li> -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <?= ($_SESSION['user_name']); ?>
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
    </ul>
  </li>
<?php endif; ?>


       
      </ul>
    </div>
  </div>
</nav>




<div class="dashboardview container mt-5 pt-5 mb-5">
  <div class="row">
    <div class="col-md-12 text-center mt-5">
      <h1 class="display-4">Welcome <?=$_SESSION['user_name']?></h1>
    </div>
  </div>
  <div class="dashboard-content">
  <div class="row mt-4 mb-5">
    <div class="col-md-4">
      <div class="admin-card">
        <div class="card-body">
          <h5 class="card-title">Manage Products</h5>
          <p class="card-text">Add, view, and manage products in your store.</p>
          <a href="add_product.php" class="btn btn-primary">Add Product</a>
          <a href="added_products.php" class="btn btn-secondary">View Products</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="admin-card">
        <div class="card-body">
          <h5 class="card-title">Manage Categories</h5>
          <p class="card-text">Add and view product categories.</p>
          <a href="add_categories.php" class="btn btn-primary">Add Category</a>
          <a href="added_categories.php" class="btn btn-secondary">View Categories</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="admin-card">
        <div class="card-body">
          <h5 class="card-title">Orders Management</h5>
          <p class="card-text">View and manage customer orders.</p>
          <a href="orders.php" class="btn btn-primary">View Orders</a>
        </div>
      </div>
    </div>
    </div>
  </div>
<div class="row mt-4 ">
    <!-- trending Products -->
    <div class="col-md-12">
      <div class="trending-section">
        <div class="" style="text-align: center;"> 
          <h3 class="card-title mt-4">Trending Products</h3>
          <p class="card-text">Check out the latest trending products in your store.</p>
          <!-- You can add a section here to display trending products dynamically -->
           <div class="row mt-5 " style="display: flex; flex-wrap: wrap; justify-content: center;">
           <?php while ($row = mysqli_fetch_assoc($result)) { ?>
  <div class="col-md-4 mb-4">
    <div class="card h-100">
      <img src="uploads/<?= $row['images']; ?>" alt="Product Image" class="card-img-top" style="height: 70vh; object-fit: cover;">
      <div class="card-body">
        <h3 class="card-title"><?= $row['name']; ?></h3>
        <div class="container"></div>
        <p class="card-text">Small Description: <?= $row['small_description']; ?></p>
        <p class="card-text">Description: <?= $row['description']; ?></p>
        <p class="card-text">Original Price: ₹<?= $row['original_price']; ?></p>
        <p class="card-text">Selling Price: ₹<?= $row['selling_price']; ?></p>
        <p class="card-text">Quantity: <?= $row['qty']; ?></p>
        <div class="d-flex justify-content-between mt-3">
    
          <a href="#" class="btn btn-primary btn-sm">See Product</a>
        </div>
      </div>
    </div>
  </div>
            <?php } ?> 
        </div>
        <div class="col-md-12 p-4">
           <a href="trending_products.php" class="btn btn-primary">View Trending Products</a>
        </div>
        </div>
      </div>
  </div>
  
  <!-- trending Categories -->
<div class="col-md-12 mt-4">
      <div class="trending-section">
        <div class="card-body" style="text-align: center;"> 
          <h3 class="card-title mt-4">Trending Categories</h3>
          <p class="card-text">Check out the latest trending Categories in your store.</p>
          <!-- You can add a section here to display trending categories dynamically -->
           <div class="row mt-5 " style="display: flex; flex-wrap: wrap; justify-content: center;">
           <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
  <div class="col-md-4 mb-4">
    <div class="card h-100">
      <img src="catuploads/<?= $row2['image']; ?>" alt="Product Image" class="card-img-top" style="height: 70vh; object-fit: cover;">
      <div class="card-body">
        <h3 class="card-title"><?= $row2['name']; ?></h3>
        <div class="container"></div>
        <!-- <p class="card-text">Small Description: <?= $row2['small_description']; ?></p> -->
        <p class="card-text">Description: <?= $row2['description']; ?></p>
        <!-- <p class="card-text">Original Price: ₹<?= $row2['original_price']; ?></p> -->
        <!-- <p class="card-text">Selling Price: ₹<?= $row2['selling_price']; ?></p> -->
        <!-- <p class="card-text">Quantity: <?= $row2['qty']; ?></p> -->
        <div class="d-flex justify-content-between mt-3">
    
          <a href="#" class="btn btn-primary btn-sm">See Product</a>
        </div>
      </div>
    </div>
  </div>
            <?php } ?> 
        </div>
           <a href="trending_s.php" class="btn btn-primary">View Trending Products</a>
        </div>
      </div>

  




  <div class="row mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Customer Messages</h5>
            <p class="card-text">View and respond to customer messages.</p>     
            <a href="messages.php" class="btn btn-primary">View Messages</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">User Management</h5>
            <p class="card-text">Manage user accounts and roles.</p>
            <a href="users.php" class="btn btn-primary">Manage Users</a>
          </div>
        </div>
      </div>
  </div>

  <div class="row mt-5">
     <div class="col-md-12">
        <div class="trending-section">
          <div class="card-body">
            <h5 class="card-title">Reports</h5>

            <p class="card-text">Generate and view reports on sales and performance.</p>
            <div class="buttons " style="display: inline; flex-direction: row;">
            <a href="sales_report.php" class="btn btn-primary">Sales Reports</a>
            <a href="stock_alerts.php" class="btn btn-secondary">Stock Alerts</a>
            <a href="performance.php" class="btn btn-secondary">Performance Analytics</a>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>