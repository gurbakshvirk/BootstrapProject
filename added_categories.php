<?php

session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";


$conn = new mysqli($hostname, $username, $password, $dbname);
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['edit_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    
    // Handle image upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $path = "catuploads/" . $image;
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    $upload_path = "catuploads/" . $filename;

    // Insert category into database
    $query = "INSERT INTO `categories` (`name`, `slug`, `description`, `image`, `status`,`popular`, `meta_title`, `meta_keywords`, `meta_description`) 
              VALUES ('$name', '$slug', '$description', '$filename', '$status','$popular', '$meta_title', '$meta_keywords', '$meta_description')";




    if (mysqli_query($conn, $query)) {
        if (move_uploaded_file($image_tmp, $upload_path)) {
            $_SESSION['message'] = "Category Added Successfully";
        } else {
            $_SESSION['message'] = "Category saved, but image upload failed!";
        }
        header("Location: add_categories.php");
        exit();
    } else {
        $_SESSION['message'] = "Something went wrong";
        header("Location: add_categories.php");
        exit();
    }
}


// <div class="row mt-5 " style="display: flex; flex-wrap: wrap; justify-content: center;">
// <?php while ($row2 = mysqli_fetch_assoc($result)) { ?>
<!-- //   <div class="col-md-4 mb-4">
//     <div class="card h-100">
//       <img src="uploads/<?= $row2['images']; ?>" alt="Product Image" class="card-img-top" style="height: 70vh; object-fit: cover;">
//       <div class="card-body">
//         <h5 class="card-title">Product Name: <?= $row2['name']; ?></h5>
//         <div class="container"></div>
//         <p class="card-text">Category ID: <?= $row2['category_id']; ?></p>
//         <p class="card-text">Product ID: <?= $row2['id']; ?></p>
//         <p class="card-text">Slug: <?= $row2['slug']; ?></p>
//         <p class="card-text">Small Description: <?= $row2['small_description']; ?></p>
//         <p class="card-text">Description: <?= $row2['description']; ?></p>
//         <p class="card-text">Original Price: ₹<?= $row2['original_price']; ?></p>
//         <p class="card-text">Selling Price: ₹<?= $row2['selling_price']; ?></p>
//         <p class="card-text">Quantity: <?= $row2['qty']; ?></p>
//         <p class="card-text">Status: <?= $row2['status'] ? '1' : '0'; ?></p>
//         <p class="card-text">Trending: <?= $row2['trending'] ? '1' : '0'; ?></p>
//         <p class="card-text">Meta Title: <?= $row2['meta_title']; ?></p>
//         <p class="card-text">Meta Description: <?= $row2['meta_description']; ?></p>
//         <p class="card-text">Meta Keywords: <?= $row2['meta_keywords']; ?></p>
//         <div class="d-flex justify-content-between mt-3">
//           <a href="#" class="btn btn-primary btn-sm">See Product</a>
//           <a href="edit_product.php?id=<?= $row2['id']; ?>" class="btn btn-warning btn-sm">Edit Product</a>
//           <a href="#" class="btn btn-danger btn-sm">Delete Product</a>
//         </div>
//       </div>
//     </div>
//   </div>
// <?php  ?> -->

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Added Categories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
<div class="container">
    <button class="back">
        <a href="admin_dashboard.php" style="text-decoration: none; color: black;">Back</a>
    </button>
</div>

</header>

<div class="container mt-5 pt-5 ">
    <h1>Added Categories to DataBase By "<?= ($_SESSION['user_name']); ?>"</h1>
      <div class="row mt-5 " style="display: flex; flex-wrap: wrap; justify-content: center;">
        <?php while ($row2 = mysqli_fetch_assoc($result)) { ?>
          <div class="col-md-4 mb-4">
            <div class="card"></div>
            <img src="catuploads/<?= $row2['image']; ?>" class="card-img-top" alt="<?= $row2['name']; ?>">
            <div class="card-body">
              <h5 class="card-title"><?= $row2['name']; ?></h5>
              <p class="card-text">Description:<?= $row2['description']; ?></p>
              <p class="card-text">Slug: <?= $row2['slug']; ?></p>
              <p class="card-text">Meta Title: <?= $row2['meta_title']; ?></p>
              <p class="card-text">Meta Description: <?= $row2['meta_description']; ?></p>
              <p class="card-text">Meta Keywords: <?= $row2['meta_keywords']; ?></p>
              <p class="card-text">Status: <?= $row2['status'] ? '1' : '0'; ?></p>
              <p class="card-text">popular: <?= $row2['popular'] ? '1' : '0'; ?></p>
              <div class="d-flex justify-content-between mt-3">
                <a href="#" class="btn btn-primary btn-sm">See Category</a>
                <a href="edit_categories.php?id=<?= $row2['id']; ?>" class="btn btn-warning btn-sm">Edit Category</a>
                <a href="#" class="btn btn-danger btn-sm">Delete Category</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body> 
</html>
<?php
// Close the database connection
mysqli_close($conn);  
?>
    