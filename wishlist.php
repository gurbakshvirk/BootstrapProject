<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";

$conn = new mysqli($hostname, $username, $password, $dbname);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.id, products.name, products.images, products.selling_price 
        FROM wishlist 
        JOIN products ON wishlist.product_id = products.id 
        WHERE wishlist.user_id = $user_id";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ClassicCave</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
  <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

  <!-- jQuery (required for Owl Carousel) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
  <?php
include'indexnav.php';
?>

<h2>Your Wishlist</h2>

<?php if (isset($_SESSION['message'])): ?>
  <div class="alert alert-info"><?= $_SESSION['message']; ?></div>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<div class="container my-5">
  <div class="row">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-3 mb-4">
              <div class="card h-100 shadow-sm">
                <?php
              // Get first image from product_images table
              $product_id = $row['id'];
              $image_query = "SELECT image_path FROM product_images WHERE product_id = $product_id LIMIT 1";
              $image_result = mysqli_query($conn, $image_query);
              
              $image = mysqli_fetch_assoc($image_result);
              $image_path = $image ? 'uploads/' . $image['image_path'] : 'assets/default.jpg'; // fallback image
            ?>
                <img src="<?= $image_path ?>" class="card-img-top" alt="<?= $row['name']; ?>" style="height: 250px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><?= $row['name']; ?></h5>
                  <p class="card-text fw-bold ">₹<?= $row['selling_price']; ?></p>
                  <a href="remove_from_wishlist.php?id=<?= $row['id']; ?>" class="btn btn-danger mt-auto">Remove</a>
                </div>
              </div>
            </div>
            <?php
        }
    } else {
        echo "<div class='col-12'><p>You have no items in your wishlist.</p></div>";
    }
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
