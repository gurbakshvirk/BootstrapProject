<!-- Description: This file displays the products added to the cart by the user -->
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


$sql ="select * from categories";
$result = mysqli_query($conn, $sql);


// while ($row = mysqli_fetch_assoc($result)) {
//     // $_SESSION['category_id'] = $row['category_id'];
//     $_SESSION['name'] = $row['name'];
//     $_SESSION['slug'] = $row['slug'];
//     $_SESSION['description'] = $row['description'];
//     $_SESSION['meta_title'] = $row['meta_title'];
//     $_SESSION['meta_description'] = $row['meta_description'];
//     $_SESSION['meta_keywords'] = $row['meta_keywords'];
//     $_SESSION['status'] = $row['status'];
//     $_SESSION['popular'] = $row['popular'];
//     $_SESSION['id'] = $row['id'];
//     $_SESSION['image'] = $row['image'];
// }
    // $name = $_POST['name'];
    // $slug = $_POST['slug'];
    // $description = $_POST['description'];
    // $meta_title = $_POST['meta_title'];
    // $meta_description = $_POST['meta_description'];
    // $meta_keywords = $_POST['meta_keywords'];
    // $status = isset($_POST['status']) ? '1' : '0';
    // $popular = isset($_POST['popular']) ? '1' : '0';

    // $image = $_FILES['image']['name'];
    // $path = "./uploads" . $image;
    // $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    // $filename = time() . '.' . $image_ext;
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
          <a class="nav-link active text-primary" aria-current="page" href="index.php">Home</a>
        </li>
<?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?>
  <li class="nav-item">
    <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Products
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="add_product.php">Add Product</a></li>
      <li><a class="dropdown-item" href="added_products.php">View Products</a></li>
    </ul>
  </li>
  <li class="nav-item dropdown">
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
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Reports</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="sales_report.php">Sales Reports</a></li>
      <li><a class="dropdown-item" href="stock_alerts.php">Stock Alerts</a></li>
      <li><a class="dropdown-item" href="performance.php">Performance Analytics</a></li>
    </ul>
  </li>
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
</header>
<div class="container mt-5 pt-5">
    <h1>Added Categories to DataBase By "<?= ($_SESSION['user_name']); ?>"</h1>
            <!-- <div class="card" style="width:400px">
                    <img src="catuploads/<?= $_SESSION['image']; ?>" alt="Category Image" style="width: 100%; height: auto;">
                    <div class="card-body">
                        <h5 class="card-title">Category Name: <?= $_SESSION['name']; ?></h5>
                        <p class="card-text">Slug: <?= $_SESSION['slug']; ?></p>
                        <p class="card-text">Description: <?= $_SESSION['description']; ?></p>
                        <p class="card-text">Meta Title: <?= $_SESSION['meta_title']; ?></p>
                        
                        <p class="card-text">Meta Description: <?= $_SESSION['meta_description']; ?></p>
                        <p class="card-text">Meta Keywords: <?= $_SESSION['meta_keywords']; ?></p>
                        <p class="card-text">Status: <?= $_SESSION['status'] ? 'Active' : 'Inactive'; ?></p>
                        <p class="card-text">Popular: <?= $_SESSION['popular'] ? 'Yes' : 'No'; ?></p>
                        <a href="#" class="btn btn-primary">See category</a>
                    </div>
            </div> -->

            <div class="row mt-5" style="display: flex; flex-wrap: wrap; justify-content: center;">
                    <?php
                      while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                        <!-- $imagePath = 'catuploads/' . $row['image']; -->
                         <div class="card" style="width:400px; margin: 10px;">
                            <img src="catuploads/<?= $row['image']; ?>" alt="Category Image" style="width: 100%; height: 70vh; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Category Name: <?= $row['name']; ?></h5>
                                <p class="card-text">Slug: <?= $row['slug']; ?></p>
                                <p class="card-text">Description: <?= $row['description']; ?></p>
                                <p class="card-text">Meta Title: <?= $row['meta_title']; ?></p>
                                <p class="card-text">Meta Description: <?= $row['meta_description']; ?></p>
                                <p class="card-text">Meta Keywords: <?= $row['meta_keywords']; ?></p>
                                <p class="card-text">Status: <?= $row['status'] ? 'Active' : 'Inactive'; ?></p>
                                <p class="card-text">Popular: <?= $row['popular'] ? 'Yes' : 'No'; ?></p>
                                <div class="d-flex flex-wrap gap-2 mt-3 justify-content-center">

                                
                                <a href="#" class="btn btn-primary">See category</a>
                                
                                <a href="#" class="btn btn-warning">Edit category</a>
                                
                                <a href="#" class="btn btn-danger">Delete category</a>
                                </div>
                            </div>
                         </div>



                        <?php
                      }
                    ?>
            </div>
            </div>
     

</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>