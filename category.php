<?php
session_start();

// DB connection
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ccbs";

$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get category ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid category!";
    exit;
}

$category_id = intval($_GET['id']);

// Get category name
$cat_query = "SELECT name FROM categories WHERE id = $category_id AND status = 1 LIMIT 1";
$cat_result = mysqli_query($conn, $cat_query);

if (mysqli_num_rows($cat_result) == 0) {
    echo "Category not found!";
    exit;
}

$category = mysqli_fetch_assoc($cat_result);
$category_name = $category['name'];

// Fetch products in the category
$product_query = "SELECT * FROM products WHERE category_id = $category_id AND status = 1";
$product_result = mysqli_query($conn, $product_query);
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

    <!-- Navbar -->
    <?php include 'indexnav.php'; ?>

    <div class="container my-5">
        <h2 class="text-center mb-4"><?php echo $category_name; ?></h2>
        <div class="row g-4">



           <div class="row mt-5">
    <?php
    if (mysqli_num_rows($product_result) > 0) {
        while ($product = mysqli_fetch_assoc($product_result)) {
            ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div id="carousel<?= $product['id']; ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $product_id = $product['id'];
                            $img_query = "SELECT image_path FROM product_images WHERE product_id = $product_id";
                            $img_result = mysqli_query($conn, $img_query);
                            $active_set = false;
                            if (mysqli_num_rows($img_result) > 0):
                                while ($img = mysqli_fetch_assoc($img_result)):
                                    $active_class = !$active_set ? 'active' : '';
                                    $active_set = true;
                                    ?>
                                    <div class="carousel-item <?= $active_class ?>">
                                        <img src="uploads/<?= $img['image_path']; ?>" class="d-block w-100"
                                            alt="Product Image" style="height: 40vh; object-fit: cover;">
                                    </div>
                                <?php endwhile;
                            else: ?>
                                <div class="carousel-item active">
                                    <img src="uploads/<?= $product['images']; ?>" class="d-block w-100"
                                        alt="Single Image" style="height: 40vh; object-fit: cover;">
                                </div>
                            <?php endif; ?>
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carousel<?= $product['id']; ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carousel<?= $product['id']; ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>

                    <div class="card-body text-center">
                        <h5 class="card-title mb-1"><?= $product['name']; ?></h5>
                        <p class="mb-2"><strong>₹<?= $product['selling_price']; ?></strong></p>
                        <a href="single_product.php?id=<?= $product['id']; ?>" class="btn btn-outline-dark btn-sm">Explore</a>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p class='text-center'>No products found in this category.</p>";
    }
    ?>
</div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>