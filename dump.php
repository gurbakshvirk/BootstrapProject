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






<!-- old add products page -->
 <?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";
$conn = new mysqli($hostname, $username, $password, $dbname);
function getAll($table) {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM $table");
}

if (isset($_POST['add_product_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $images = $_FILES['images']['name'];
    $image_tmp = $_FILES['images']['tmp_name'];
    $path = "uploads/" . $images;
    $image_ext = pathinfo($images, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    $upload_path = "uploads/" . $filename;
   $query =  "INSERT INTO `products` (`category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `images`, `qty`, `status`, `trending`, `meta_title`, `meta_keywords`, `meta_description`) 
                            VALUES ( '$category_id', '$name', '$slug', '$small_description', '$description', ' $original_price', '$selling_price', '$filename', '$qty', '$status', '$trending', '$meta_title', '$meta_description', '$meta_keywords')";



// $cate_query_run = mysqli_query($con, $cate_query);
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
    if (move_uploaded_file($image_tmp, $upload_path)) {
        $_SESSION['message'] = "Product Added Successfully";
    } else {
        $_SESSION['message'] = "Product saved, but image upload failed!";
    }
    header("Location: add_product.php");
    exit();
    }
    
    
    else {
        $_SESSION['message'] = "Something went wrong";
        header("Location: add_product.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
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
<div class="container">
    <button class="back">
        <a href="admin_dashboard.php" style="text-decoration: none; color: black;">Back</a>
    </button>
</div>



<div class="container mt-5 pt-5">
    <h2>Add Product</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <!-- <div class="alert alert-info"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div> -->
    <?php endif; ?>
    <form action="" method="POST" enctype="multipart/form-data">

        <!-- Category Dropdown -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Select Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option selected >Select category</option>
                <?php
                $categories = getAll("categories");
                if ($categories && mysqli_num_rows($categories) > 0):
                    foreach ($categories as $item): ?>
                        <option value="<?= $item['id']; ?>"><?=($item['name']); ?></option>
                    <?php endforeach;
                else: ?>
                    <option>No Category Available</option>
                <?php endif; ?>
            </select>
        </div>

        <!-- Name -->
        <div class="mb-3"> 
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Slug -->
        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" required>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label class="form-label">Original Price</label>
            <input type="number" name="original_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Selling Price</label>
            <input type="number" name="selling_price" class="form-control" required>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="qty" class="form-control" required>
        </div>

        <!-- File Upload -->
        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <input type="file" name="images" class="form-control" required>
        </div>

        <!-- Small Description -->
        <div class="mb-3">
            <label class="form-label">small description</label>
            <input type="text" name="small_description" class="form-control" required>
        </div>
        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        <!-- Meta Title -->
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" required> 
        </div>
        <!-- Meta Description -->
        <div class="mb-3">  
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="3" required></textarea>
        </div>
        <!-- Meta Keywords -->
        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <input type="text" name="meta_keywords" class="form-control" required>
        </div>  
        
        <!-- Checkboxes -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="status">
            <label class="form-check-label" for="status">Status</label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="trending" id="trending">
            <label class="form-check-label" for="trending">Trending</label>
        </div>

        <!-- Submit -->
        <button type="submit" name="add_product_btn" class="btn btn-primary">Add Product</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>








<!-- added_products -->
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





if (isset($_POST['edit_product_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $images = $_FILES['images']['name'];
    $image_tmp = $_FILES['images']['tmp_name'];
    $path = "uploads/" . $images;
    $image_ext = pathinfo($images, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    $upload_path = "uploads/" . $filename;
   $query =  "INSERT INTO `products` (`category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `images`, `qty`, `status`, `trending`, `meta_title`, `meta_keywords`, `meta_description`) 
                            VALUES ( '$category_id', '$name', '$slug', '$small_description', '$description', ' $original_price', '$selling_price', '$filename', '$qty', '$status', '$trending', '$meta_title', '$meta_description', '$meta_keywords')";



// $cate_query_run = mysqli_query($con, $cate_query);
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
    if (move_uploaded_file($image_tmp, $upload_path)) {
        $_SESSION['message'] = "Product Added Successfully";
    } else {
        $_SESSION['message'] = "Product saved, but image upload failed!";
    }
    header("Location: add_product.php");
    exit();
    } else {
        $_SESSION['message'] = "Something went wrong";
        header("Location: add_product.php");
        exit();
    }
}




if (isset($_POST['delete_product'])) {
    $category_id = $_GET['category_id'];
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $DLT_query = "DELETE FROM products WHERE id = '$id'";
    $query_run = mysqli_query($conn, $DLT_query);

    if ($query_run) {
        $_SESSION['message'] = "Product deleted successfully!";
        header("Location: added_products.php");
        exit();
    } else {
        $_SESSION['message'] = "Something went wrong";
        header("Location: added_products.php");
        exit();
    }
}


    if ($query_run) {
        $_SESSION['message'] = "Product deleted, but image upload failed!";
    header("Location: added_products.php");
    exit();
    } else {
        $_SESSION['message'] = "Something went wrong";
        header("Location: added_products.php");
        exit();
    }}
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
<div class="container">
    <button class="back">
        <a href="admin_dashboard.php" style="text-decoration: none; color: black;">Back</a>
    </button>
</div>

<div class="container mt-5 pt-5 ">
    <h1>Added Products to DataBase By "<?= ($_SESSION['user_name']); ?>"</h1>
    
      <div class="row mt-5 " style="display: flex; flex-wrap: wrap; justify-content: center;">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
  <div class="col-md-4 mb-4">
    <div class="card h-100">
<div id="carousel<?= $row['id']; ?>" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
    $product_id = $row['id'];
    $img_query = "SELECT image_path FROM product_images WHERE product_id = $product_id";
    $img_result = mysqli_query($conn, $img_query);
    $active_set = false;
    if (mysqli_num_rows($img_result) > 0):
        while ($img = mysqli_fetch_assoc($img_result)):
            $active_class = !$active_set ? 'active' : '';
            $active_set = true;
    ?>
      <div class="carousel-item <?= $active_class ?>">
        <img src="uploads/<?= $img['image_path']; ?>" class="d-block w-100" alt="Product Image" style="height: 70vh; object-fit: cover;">
      </div>
    <?php endwhile;
    else: ?>
      <div class="carousel-item active">
        <img src="uploads/<?= $row['images']; ?>" class="d-block w-100" alt="Single Image" style="height: 70vh; object-fit: cover;">
      </div>
    <?php endif; ?>
  </div>
  <!-- Controls (optional) -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?= $row['id']; ?>" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel<?= $row['id']; ?>" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

      <div class="card-body">
        <h5 class="card-title">Product Name: <?= $row['name']; ?></h5>
        <div class="container"></div>
        <p class="card-text">Category ID: <?= $row['category_id']; ?></p>
        <p class="card-text">Product ID: <?= $row['id']; ?></p>
        <p class="card-text">Slug: <?= $row['slug']; ?></p>
        <p class="card-text">Small Description: <?= $row['small_description']; ?></p>
        <p class="card-text">Description: <?= $row['description']; ?></p>
        <p class="card-text">Original Price: ₹<?= $row['original_price']; ?></p>
        <p class="card-text">Selling Price: ₹<?= $row['selling_price']; ?></p>
        <p class="card-text">Quantity: <?= $row['qty']; ?></p>
        <p class="card-text">Status: <?= $row['status'] ? '1' : '0'; ?></p>
        <p class="card-text">Trending: <?= $row['trending'] ? '1' : '0'; ?></p>
        <p class="card-text">Meta Title: <?= $row['meta_title']; ?></p>
        <p class="card-text">Meta Description: <?= $row['meta_description']; ?></p>
        <p class="card-text">Meta Keywords: <?= $row['meta_keywords']; ?></p>
        <div class="d-flex justify-content-between mt-3">
          <a href="#" class="btn btn-primary btn-sm">See Product</a>
          <a href="edit_product.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit Product</a>
          <a href="delete_products.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" vlaue="delete_product">Delete Product</a>
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



<!-- OLD PRODUCTS.PHP CODE -->
 <?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ccbs";

$conn = new mysqli($hostname, $username, $password, $dbname);
$sql = "SELECT * FROM products WHERE status='1'";
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
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Miniver&family=Poppins&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    /* --- Product Card Styling --- */
    <style>
  .product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 10px;
    overflow: hidden;
  }

  .product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
  }

  .product-card img {
    height: 250px;
    object-fit: cover;
  }

  .product-card .card-body {
    padding: 0.8rem 1rem;
    text-align: center;
  }

  .product-card .card-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.4rem;
  }

  .product-card .card-body p {
    font-size: 0.9rem;
    margin: 0.2rem 0;
  }

  h1 {
    font-family: 'Dancing Script', cursive;
    font-size: 2rem;
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .btn-sm {
    padding: 0.3rem 0.75rem;
    font-size: 0.8rem;
  }
</style>
</head>

<body>
  <header>
    <?php include 'indexnav.php'; ?>
  </header>

  <div class="container mt-5 pt-5">
    <h1>All Products</h1>
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
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>




<!-- OLD SINGLE PRODUCT -->


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
      
     <p>
  <strong>Stock Status:</strong>
  <?php
    $qty = $product['qty'];
    if ($qty == 0) {
        echo '<span class="badge bg-danger">Out of Stock</span>';
    } elseif ($qty <= 3) {
        echo '<span class="badge bg-warning text-dark">Only ' . $qty . ' left! Hurry up!</span>';
    } elseif ($qty <= 5) {
        echo '<span class="badge bg-warning text-dark">' . $qty . ' in stock</span>';
    } else {
        echo '<span class="badge bg-success">In Stock</span>';
    }
  ?>
</p>

      <!-- <p>
        <strong>Status:</strong>
        <?= $product['status'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'; ?>
      </p> -->
      <p>
        <strong>Trending:</strong>
        <?= $product['trending'] ? '<span class="badge bg-info text-dark">Yes</span>' : 'No'; ?>
      </p>

      <hr>
      <p><strong>Short Description:</strong><br><?= $product['small_description']; ?></p>
      

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
<p><strong>Full Description:</strong><br><?= nl2br($product['description']); ?></p>

    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

