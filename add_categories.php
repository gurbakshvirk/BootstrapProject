
<?php

session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";


$conn = new mysqli($hostname, $username, $password, $dbname);


if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $path = "catuploads/" . $image;
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    $upload_path = "catuploads/" . $filename;
    $cate_query = "INSERT INTO `categories` ( `name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `popular`, `image`, `created_at`) 
                    VALUES ( '$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status','$popular', '$filename', current_timestamp())";
//  if ($conn->query($cate_query) === TRUE) {
//         if (move_uploaded_file($image_tmp, $upload_path)) {
//             $_SESSION['message'] = "Category Added Successfully with image.";
//         } else {
//             $_SESSION['message'] = "Category added, but image upload failed!";
//         }
//         header("Location: add_categories.php");
//         exit();
//     } else {
//         $_SESSION['message'] = "Database insertion failed!";
//         header("Location: add_categories.php");
//         exit();
//     }
// }
 $cate_query_run = mysqli_query($conn, $cate_query);

    if ($cate_query_run) {
    if (move_uploaded_file($image_tmp, $upload_path)) {
        $_SESSION['message'] = "category Added Successfully";
    } else {
        $_SESSION['message'] = "category saved, but image upload failed!";
    }
    header("Location: add_categories.php");
    exit();
    } else {
        $_SESSION['message'] = "Something went wrong";
        header("Location: add_categories.php");
        exit();
    }
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
          <a class="nav-link active text-primary" aria-current="page" href="index.php">Home</a>
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
      <li><a class="dropdown-item" href="view_categories.php">View Categories</a></li>
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


    <div class="container mt-5 pt-5">
        <h1 class="mt-5 pt-5">Add New Category</h1>
         <div class="card-body">
                    <!-- Form to submit category details -->
                    <!-- 'multipart/form-data' allows file uploads -->
                    <form action="add_categories.php" method="POST" enctype="multipart/form-data">
                        <div class="row">

                         
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                            </div>

                         
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" placeholder="Enter slug" class="form-control">
                            </div>

                          
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea rows="3" name="description" placeholder="Enter description" class="form-control"></textarea>
                            </div>

                          
                            <div class="col-md-12">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                          
                            <div class="col-md-12">
                                <label for="">Meta title</label>
                                <textarea rows="3" name="meta_title" placeholder="Enter meta title" class="form-control"></textarea>
                            </div>

                            
                            <div class="col-md-12">
                                <label for="">Meta Description</label>
                                <textarea rows="3" name="meta_description" placeholder="Enter meta description" class="form-control"></textarea>
                            </div>

                          
                            <div class="col-md-12">
                                <label for="">Meta Keywords</label>
                                <textarea rows="3" name="meta_keywords" placeholder="Enter meta keywords" class="form-control"></textarea>
                            </div>

                            
                            <div class="col-md-6">
                                <label for="">Status</label><br>
                                <input type="checkbox" name="status">
                            </div>

                            
                            <div class="col-md-6">
                                <label for="">Popular</label><br>
                                <input type="checkbox" name="popular">
                            </div>

                          
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                            </div>

                        </div> 
                    </form>
                </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>