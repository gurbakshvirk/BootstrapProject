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
