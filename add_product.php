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
