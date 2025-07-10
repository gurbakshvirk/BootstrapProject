<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ccbs";

$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products WHERE trending = '1'";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM categories WHERE popular = '1'";
$result2 = mysqli_query($conn, $sql2);

$chart_query = "SELECT name, qty FROM products ORDER BY qty ASC LIMIT 10";
$chart_result = mysqli_query($conn, $chart_query);

$labels = [];
$data = [];
while ($chart_row = mysqli_fetch_assoc($chart_result)) {
    $labels[] = $chart_row['name'];
    $data[] = $chart_row['qty'];
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .scroll-container {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            scroll-snap-type: x mandatory;
            padding: 20px 10px;
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
  <div class="container-fluid">
    <div class="d-flex align-items-center">
      <ul class="navbar-nav me-3 d-flex flex-row gap-3 fs-5">
        <li class="nav-item"><a class="nav-link" href="index.php">User Panel</a></li>
        <li class="nav-item"><a class="nav-link" href="admin_view_wishlists.php">User Wishlists</a></li>
      </ul>
    </div>
    <a class="navbar-brand mx-auto d-flex flex-column align-items-center" href="admin_dashboard.php">
      <img src="assets/classic2.png" style="height: 8vh; width: 8vh;">
      <!-- <span class="fw-bold"></span> -->
    </a>
    <div class="d-flex align-items-center gap-3">
      <!-- <i class="bi bi-search"></i> -->
      <!-- <i class="bi bi-person"></i> -->
      <!-- <i class="bi bi-bag"></i> -->
      <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?>
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown">
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

<div class="container mt-5 pt-5 mb-5">
  <h1 class="text-center mt-4">Welcome <?= $_SESSION['user_name'] ?></h1>

  <!-- Admin Functional Cards -->
  <div class="row mt-4 mb-5">
    <div class="col-md-3">
      <div class="card h-100"><div class="card-body">
        <h5>Manage Products</h5>
        <p>Add, view, and manage products in your store.</p>
        <a href="add_product.php" class="btn btn-primary btn-sm">Add</a>
        <a href="added_products.php" class="btn btn-secondary btn-sm">View</a>
      </div></div>
    </div>
    <div class="col-md-3">
      <div class="card h-100"><div class="card-body">
        <h5>Manage Categories</h5>
        <p>Add and view product categories.</p>
        <a href="add_categories.php" class="btn btn-primary btn-sm">Add</a>
        <a href="added_categories.php" class="btn btn-secondary btn-sm">View</a>
      </div></div>
    </div>
    <div class="col-md-3">
      <div class="card h-100"><div class="card-body">
        <h5>Orders Management</h5>
        <p>View and manage customer orders.</p>
        <a href="admin_orders.php" class="btn btn-primary btn-sm">View Orders</a>
      </div></div>
    </div>
    <div class="col-md-3">
      <div class="card h-100"><div class="card-body">
        <h5>Inventory</h5>
        <p>Monitor and update stock levels.</p>
        <a href="inventory_management.php" class="btn btn-primary btn-sm">Inventory Dashboard</a>
      </div></div>
    </div>
  </div>

  <!-- Charts -->
  <div class="row mb-5">
    <div class="col-md-6">
      <div class="card h-100"><div class="card-body">
        <h5 class="text-center">Inventory Overview</h5>
        <canvas id="stockChart" height="250"></canvas>
      </div></div>
    </div>
    <div class="col-md-6">
      <div class="card h-100"><div class="card-body">
        <h5 class="text-center">Category Distribution</h5>
        <canvas id="categoryPieChart" height="250"></canvas>
      </div></div>
    </div>
  </div>

  <!-- Trending Products Slider -->
  <div class="mb-5">
    <h3 class="text-center">Trending Products</h3>
    <p class="text-center">Check out the latest trending products.</p>
    <div class="scroll-container">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card scroll-item">
          <?php
              // Get first image from product_images table
              $product_id = $row['id'];
              $image_query = "SELECT image_path FROM product_images WHERE product_id = $product_id LIMIT 1";
              $image_result = mysqli_query($conn, $image_query);
              $image = mysqli_fetch_assoc($image_result);
              $image_path = $image ? 'uploads/' . $image['image_path'] : 'assets/default.jpg'; // fallback image
            ?>
            <img src="<?= $image_path ?>" class="card-img-top" alt="<?= $row['name']; ?>">
          <!-- <img src="uploads/<?= $row['images']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;"> -->
          <div class="card-body">
            <h5><?= $row['name']; ?></h5>
            <p>Price: ₹<?= $row['selling_price']; ?> | Qty: <?= $row['qty']; ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
    <!-- <div class="text-center mt-2">
      <a href="trending_products.php" class="btn btn-primary">View All</a>
    </div> -->
  </div>

  <!-- Trending Categories Slider -->
  <div class="mb-5">
    <h3 class="text-center">Trending Categories</h3>
    <p class="text-center">Top categories gaining popularity.</p>
    <div class="scroll-container">
      <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
        <div class="card scroll-item">
          <img src="catuploads/<?= $row2['image']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
          <div class="card-body">
            <h5><?= $row2['name']; ?></h5>
            <p><?= $row2['description']; ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="text-center mt-2">
      <!-- <a href="trending_s.php" class="btn btn-primary">View All</a> -->
    </div>
  </div>

  <!-- Messages and Users -->
  <div class="row mb-5">
    <div class="col-md-6">
      <div class="card"><div class="card-body">
        <h5>Customer Messages</h5>
        <p>View and respond to messages.</p>
        <a href="messages.php" class="btn btn-primary btn-sm">View Messages</a>
      </div></div>
    </div>
    <div class="col-md-6">
      <div class="card"><div class="card-body">
        <h5>User Management</h5>
        <p>Manage user accounts and roles.</p>
        <a href="users.php" class="btn btn-primary btn-sm">Manage Users</a>
      </div></div>
    </div>
  </div>

  <!-- Reports Section -->
  <div class="card mb-5"><div class="card-body">
    <h5>Reports</h5>
    <p>Generate reports on sales and stock.</p>
    <a href="sales_report.php" class="btn btn-primary btn-sm">Sales Report</a>
    <a href="stock_alerts.php" class="btn btn-warning btn-sm">Stock Alerts</a>
    <a href="performance.php" class="btn btn-info btn-sm">Performance</a>
  </div></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('stockChart').getContext('2d');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($labels); ?>,
    datasets: [{
      label: 'Stock (Qty)',
      data: <?= json_encode($data); ?>,
      backgroundColor: 'rgba(75, 192, 192, 0.5)',
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 1
    }]
  },
  options: {
    scales: { y: { beginAtZero: true } },
    plugins: { legend: { display: false } }
  }
});

const ctxPie = document.getElementById('categoryPieChart').getContext('2d');
new Chart(ctxPie, {
  type: 'pie',
  data: {
    labels: <?= json_encode($categoryLabels) ?>,
    datasets: [{
      data: <?= json_encode($categoryCounts) ?>,
      backgroundColor: [
        '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A',
        '#FF9800', '#9C27B0', '#00BCD4', '#CDDC39', '#E91E63'
      ]
    }]
  },
  options: { responsive: true, plugins: { legend: { position: 'right' } } }
});
</script>
</body>
</html>
