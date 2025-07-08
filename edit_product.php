<!-- Description: This file displays the products added to the cart by the user -->
<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname =  "ccbs";


$conn = new mysqli($hostname, $username, $password , $dbname);



// Function to get all records from  tables
function getAll($table) {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM $table");
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// code from web
if (!isset($_GET['id'])) {
    $_SESSION['message'] = "No product ID provided!";
    header("Location: added_products.php");
    exit();
}


$product_id = $_GET['id'];
$query = "SELECT * FROM products WHERE id = '$product_id'";
$result = mysqli_query($conn, $query); //this line from web

if (mysqli_num_rows($result) !== 1) {
    $_SESSION['message'] = "Product not found!";
    header("Location: added_products.php");
    exit();
}
$product = mysqli_fetch_assoc($result);

// Handle update submission
if (isset($_POST['update_product'])) {
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



    // Handle image
    // $image = $_FILES['images']['name'];
    // if (!empty($image)) {
    //     $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    //     $filename = time() . '.' . $image_ext;
    //     $upload_path = "uploads/" . $filename;
    //     move_uploaded_file($_FILES['images']['tmp_name'], $upload_path);
    // } else {
    //     $filename = $_POST['old_image'];
    // }
    




    if (!empty($_FILES['images']['name'][0])) {
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $image_name = $_FILES['images']['name'][$key];
        $image_tmp = $_FILES['images']['tmp_name'][$key];

        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $filename = time() . '_' . $key . '.' . $image_ext;
        $upload_path = "uploads/" . $filename;

        if (move_uploaded_file($image_tmp, $upload_path)) {
            $insert_img_query = "INSERT INTO product_images (product_id, image_path) VALUES ('$product_id', '$filename')";
            mysqli_query($conn, $insert_img_query);
        }
    }
}





    $update_query = "UPDATE products SET 
        category_id = '$category_id',
        name = '$name',
        slug = '$slug',
        small_description = '$small_description',
        description = '$description',
        original_price = '$original_price',
        selling_price = '$selling_price',
        qty = '$qty',
        status = '$status',
        trending = '$trending',
        meta_title = '$meta_title',
        meta_description = '$meta_description',
        meta_keywords = '$meta_keywords',
        images = '$filename'
        WHERE id = '$product_id'";

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['message'] = "Product updated successfully!";
        header("Location: added_products.php");
        exit();
    } else {
        $_SESSION['message'] = "Update failed!";
    }
}
?>





<!-- $query = "SELECT * FROM products WHERE id=$_GET['id']"; //this line from web


// $sql ="select * from products where status='1'";
// $result = mysqli_query($conn, $sql); -->

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
    <h1>Edit Product</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="old_image" value="<?= $product['images']; ?>">

         <!-- Category Dropdown -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Select Category</label>
            <select name="category_id" id="category_id" class="form-select">
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
        <div class="mb-3"><label>Name</label>
            <input type="text" name="name" value="<?= $product['name']; ?>" class="form-control">
        </div>
        <div class="mb-3"><label>Slug</label>
            <input type="text" name="slug" value="<?= $product['slug']; ?>" class="form-control">
        </div>
        <div class="mb-3"><label>Small Description</label>
            <textarea name="small_description" class="form-control"><?= $product['small_description']; ?></textarea>
        </div>
        <div class="mb-3"><label>Description</label>
            <textarea name="description" class="form-control"><?= $product['description']; ?></textarea>
        </div>
        <div class="mb-3"><label>Original Price</label>
            <input type="text" name="original_price" value="<?= $product['original_price']; ?>" class="form-control">
        </div>
        <div class="mb-3"><label>Selling Price</label>
            <input type="text" name="selling_price" value="<?= $product['selling_price']; ?>" class="form-control">
        </div>
        <div class="mb-3"><label>Quantity</label>
            <input type="number" name="qty" value="<?= $product['qty']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <input type="checkbox" name="status" <?= $product['status'] ? 'checked' : ''; ?>>
        </div>
        <div class="mb-3">
            <label>Trending</label>
            <input type="checkbox" name="trending" <?= $product['trending'] ? 'checked' : ''; ?>>
        </div>
        <div class="mb-3"><label>Meta Title</label>
            <input type="text" name="meta_title" value="<?= $product['meta_title']; ?>" class="form-control">
        </div>
        <div class="mb-3"><label>Meta Description</label>
            <textarea name="meta_description" class="form-control"><?= $product['meta_description']; ?></textarea>
        </div>
        <div class="mb-3"><label>Meta Keywords</label>
            <input type="text" name="meta_keywords" value="<?= $product['meta_keywords']; ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <!-- <img src="uploads/<?= $product['images']; ?>" width="120" class="img-thumbnail"> -->
            <!-- <label>Other Uploaded Images:</label><br> -->
<div class="d-flex flex-wrap gap-2">
<?php
$image_query = "SELECT * FROM product_images WHERE product_id = '$product_id'";
$image_result = mysqli_query($conn, $image_query);
while ($img = mysqli_fetch_assoc($image_result)) {
?>
    <div class="position-relative">
        <img src="uploads/<?= $img['image_path']; ?>" width="100" class="img-thumbnail">
        <a href="delete_image.php?id=<?= $img['id']; ?>&product_id=<?= $product_id ?>" class="btn btn-sm btn-danger position-absolute top-0 end-0">X</a>
    </div>
<?php } ?>
</div>

        </div>
        <div class="mb-3">
            <label>Change Image</label>
            <!-- <input type="file" name="images" class="form-control"> -->
             <input type="file" name="images[]" class="form-control" multiple>

        </div>

        <button type="submit" name="update_product" class="btn btn-success">Update Product</button>
    </form>



    
      <!-- <div class="row mt-5 " style="display: flex; flex-wrap: wrap; justify-content: center;">
<?php while ($product = mysqli_fetch_assoc($result)) { ?>
  <div class="col-md-4 mb-4">
    <div class="card h-100">
      <img src="uploads/<?= $product['images']; ?>" alt="Product Image" class="card-img-top" style="height: 70vh; object-fit: cover;">
      <div class="card-body">
        <h3 class="card-title"><?= $product['name']; ?></h3>
        <div class="container"></div>
       
        <p class="card-text">Small Description: <?= $product['small_description']; ?></p>
        <p class="card-text">Description: <?= $product['description']; ?></p>
        <p class="card-text">Original Price: ₹<?= $product['original_price']; ?></p>
        <p class="card-text">Selling Price: ₹<?= $product['selling_price']; ?></p>
        <p class="card-text">Quantity: <?= $product['qty']; ?></p>
        <p class="card-text">Status: <?= $product['status'] ? '1' : '0'; ?></p>
        <p class="card-text">Trending: <?= $product['trending'] ? '1' : '0'; ?></p>
        <p class="card-text">Meta Title: <?= $product['meta_title']; ?></p>
        <p class="card-text">Meta Description: <?= $product['meta_description']; ?></p>
        <p class="card-text">Meta Keywords: <?= $product['meta_keywords']; ?></p>

        <div class="d-flex justify-content-between mt-3">
          
          <a href="#" class="btn btn-primary btn-sm">See Product</a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
</div> -->

     

</div>
    

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>