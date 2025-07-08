    INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `popular`, `image`, `created_at`) 
    
    
    VALUES (NULL, 'Jeans', 'Jeans', 'Jeans best ', 'Jeans', 'Jeans', 'Jeans', '1', '1', '1750951232.jpg', '2025-06-26 20:50:32');
else{
 echo"connection okayy";
}

if(!isset($_GET['id'])){
    $_SESSION['message'] = "Invalid Category ID";
    header("Location: added_categories.php");
    exit();
}

$category_id = $_GET['id'];
$sql = "SELECT * FROM categories WHERE id = '$category_id'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) !== 1 ){
    $_SESSION['message'] = "Category not found";
    header("location: added_categories.php");
    exit();
}
$category = mysqli_fetch_assoc($result);

handle update submission
if(isset($_POST['update_category'])){
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $popular = isset($_POST['popular']) ? '1' : '0';
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];



    Handle image upload
    $image = $_FILES['image']['name'];
    if(!empty($image)){
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;
        $upload_path = "catuploads/" . $filename;
       move_uploaded_file($image_tmp, $upload_path);
    }else{
        $filename = $_POST['image']; // Keep the old image if no new image is uploaded
    }
    $update_query = "UPDATE categories SET
        // -- category_id = '$category_id',
        // name = '$name',
        // slug = '$slug',
        // description = '$description',
        // image = '$filename',
        // status = '$status',
        // popular = '$popular',
        // meta_title = '$meta_title',
        // meta_keywords = '$meta_keywords',
        // meta_description = '$meta_description'
        // WHERE id = '$category_id'";
 //
    // Redirect to the categories page with a success message
    // $_SESSION['message'] = "Category Updated Successfully";
    // header("Location: added_categories.php");
    // exit();
    
    // }





    <!-- old navbar --> of admin dashboard
         <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
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
        <li class="nav-item">
          <a class="nav-link" href="admin_view_wishlists.php">User Wishlists</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li> -->
<!-- <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?> -->
  <!-- <li class="nav-item">
    <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
  </li> -->
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
  <!-- <li class="nav-item dropdown">
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
  </div> -->
<!-- </nav> --> 





navbar of index page
 <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
      <div class="container-fluid ">
        <a class="navbar-brand fs-6 d-flex align-items-center" href="index.php">
          <img src="assets/classic2.png" style="height: 8vh; width: 8vh;">
          <span style="display:inline-block; width:auto; height:auto; margin-left: 5px;">ClassicCave</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <a class="nav-link" href="wishlist.php">Wishlist</a>
            </li>
            <li class="nav-item">
              <?php if (isset($_SESSION['user_id'])): ?>
                <a class="nav-link" href="cart.php?id=<?= $_SESSION['user_id'] ?>">Cart</a>
              <?php endif; ?>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <?= ($_SESSION['user_name']); ?>
                </a>
                <ul class="dropdown-menu">
                  <!-- <li><a class="dropdown-item" href="profile.php">Profile</a></li> -->
                  <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <li><a class="dropdown-item" href="admin_dashboard.php">Admin Panel</a></li>
                  <?php endif; ?>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                </ul>
              </li>
            <?php else: ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
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






    old products.php page


    <!-- Description: This file displays the products added to the cart by the user -->
<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ccbs";


$conn = new mysqli($hostname, $username, $password, $dbname);
$sql = "select * from products where status='1'";
$result = mysqli_query($conn, $sql);
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
  <link
    href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Miniver&family=Poppins&family=Roboto&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
  <header>
    <?php
    include 'indexnav.php';
    ?>
  </header>
  <div class="container mt-5 pt-5 ">
    <h1>All Products</h1>



    <!-- <div class="row mt-5 " style="display: flex; flex-wrap: wrap; justify-content: center;"> -->
       <div class="row gy-4">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-md-4 mb-4">
          <div class="product-card w-100 d-flex flex-column">
          <div class="product-content">
            <img src="uploads/<?= $row['images']; ?>" alt="Product Image" class="card-img-top"
              style="height: 70vh; object-fit: cover;">
            <div class="card-body">
              <h3 class="product-title mt-2"><?= $row['name']; ?></h3>
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
        </div>
      <?php } ?>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>






<!-- trending products code from admin dashboard -->
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





  <!-- admin dashboard -->
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
<?php
$chart_query = "SELECT name, qty FROM products ORDER BY qty ASC LIMIT 10"; // top 10 low-stock products
$chart_result = mysqli_query($conn, $chart_query);

$labels = [];
$data = [];

while ($chart_row = mysqli_fetch_assoc($chart_result)) {
    $labels[] = $chart_row['name'];
    $data[] = $chart_row['qty'];
}
?><?php
$categoryChartQuery = "
  SELECT categories.name AS category_name, COUNT(products.id) AS product_count
  FROM categories
  LEFT JOIN products ON categories.id = products.category_id
  GROUP BY categories.id
  ORDER BY product_count DESC
";

$categoryChartResult = mysqli_query($conn, $categoryChartQuery);

$categoryLabels = [];
$categoryCounts = [];

while ($row = mysqli_fetch_assoc($categoryChartResult)) {
    $categoryLabels[] = $row['category_name'];
    $categoryCounts[] = $row['product_count'];
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
    <style>
      .scroll-container {
  display: flex;
  overflow-x: auto;
  gap: 20px;
  scroll-snap-type: x mandatory;
  padding-bottom: 20px;
  padding-left: 10px;
}
.scroll-container::-webkit-scrollbar {
  height: 8px;
}
.scroll-container::-webkit-scrollbar-thumb {
  background-color: #ccc;
  border-radius: 4px;
}
.scroll-item {
  flex: 0 0 auto;
  width: 250px;
  scroll-snap-align: start;
}

    </style>
</head>
<body>

<!-- Main Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
  <div class="container-fluid">

    <!-- Left links -->
    <div class="d-flex align-items-center">
      <ul class="navbar-nav me-3 d-flex flex-row gap-3 fs-5">
        <li class="nav-item">
          <a class="nav-link" href="index.php">User Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_view_wishlists.php">User Wishlists</a>
        </li>
      </ul>
    </div>

    <!-- Center logo -->
    <a class="navbar-brand mx-auto d-flex flex-column align-items-center" href="admin_dashboard.php">
      <img src="assets/classic2.png" style="height: 8vh; width: 8vh;">
      <span class="fw-bold">ClassicCave</span>
    </a>

    <!-- Right icons -->
    <div class="d-flex align-items-center gap-3">
      <!-- <div>Austria | INR ₹</div> -->
      <i class="bi bi-search" style="font-size: 1.2rem; cursor: pointer;"></i>
      <i class="bi bi-person" style="font-size: 1.2rem; cursor: pointer;"></i>
      <i class="bi bi-bag" style="font-size: 1.2rem; cursor: pointer;"></i>

      <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?>
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= htmlspecialchars($_SESSION['user_name']); ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
          </ul>
        </div>
      <?php endif; ?>
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
    <div class="col-md-3">
      <div class="admin-card">
        <div class="card-body">
          <h5 class="card-title">Manage Products</h5>
          <p class="card-text">Add, view, and manage products in your store.</p>
          <a href="add_product.php" class="btn btn-primary">Add Product</a>
          <a href="added_products.php" class="btn btn-secondary">View Products</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="admin-card">
        <div class="card-body">
          <h5 class="card-title">Manage Categories</h5>
          <p class="card-text">Add and view product categories.</p>
          <a href="add_categories.php" class="btn btn-primary">Add Category</a>
          <a href="added_categories.php" class="btn btn-secondary">View Categories</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="admin-card">
        <div class="card-body">
          <h5 class="card-title">Orders Management</h5>
          <p class="card-text">View and manage customer orders.</p>
          <a href="admin_orders.php" class="btn btn-primary">View Orders</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
  <div class="admin-card">
    <div class="card-body">
      <h5 class="card-title">Manage Inventory</h5>
      <p class="card-text">Monitor and update product stock levels.</p>
      <a href="inventory_management.php" class="btn btn-primary">Inventory Dashboard</a>
    </div>
  </div>
</div>

    </div>
  </div>

<!-- Charts Row: Stock Chart + Category Pie Chart Side by Side -->
<div class="row mt-5">
  <!-- Inventory Bar Chart -->
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title text-center">Inventory Overview</h5>
        <canvas id="stockChart" height="250"></canvas>
      </div>
    </div>
  </div>

  <!-- Category Distribution Pie Chart -->
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title text-center">Product Distribution by Category</h5>
        <canvas id="categoryPieChart" height="250"></canvas>
      </div>
    </div>
  </div>
</div>
<!-- </div> -->









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

</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <canvas id="stockChart" width="400" height="200"></canvas> -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('stockChart').getContext('2d');
  const stockChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($labels); ?>,
      datasets: [{
        label: 'Available Stock (Qty)',
        data: <?= json_encode($data); ?>,
        backgroundColor: 'rgba(75, 192, 192, 0.5)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { enabled: true }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { stepSize: 1 }
        }
      }
    }
  });

  const ctxPie = document.getElementById('categoryPieChart').getContext('2d');
  const categoryPieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
      labels: <?= json_encode($categoryLabels) ?>,
      datasets: [{
        data: <?= json_encode($categoryCounts) ?>,
        backgroundColor: [
          '#FF6384', '#36A2EB', '#FFCE56',
          '#8BC34A', '#FF9800', '#9C27B0',
          '#00BCD4', '#CDDC39', '#E91E63'
        ],
        borderColor: '#fff',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'right',
          labels: {
            boxWidth: 15
          }
        }
      }
    }
  });
</script>



</body>
</html>