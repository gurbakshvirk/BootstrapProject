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