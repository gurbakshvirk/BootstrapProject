 <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
      <div class="container-fluid">

        <!-- Logo for mobile view -->
        <!-- Logo for mobile view -->
<div class="d-flex d-lg-none w-100  ">
  <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
    <img src="assets/classic2.png" alt="Logo" style="height: 10vh;"> <!-- increased from 5.5vh -->
    <span class="fw-bold" style="font-size: 16px;">ClassicCave</span>
  </a>
</div>
        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
          aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse w-100" id="navbarContent">

          <!-- LEFT NAV LINKS -->
          <div class="d-flex align-items-center justify-content-start flex-grow-1">
            <ul class="navbar-nav flex-row flex-lg-row flex-column gap-3 gap-lg-3" style="font-size: 15px;">
              <li class="nav-item">
                <a class="nav-link" href="./index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="products.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="wishlist.php">Wishlist</a>
              </li>
              <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                  <a class="nav-link" href="cart.php?id=<?= $_SESSION['user_id'] ?>">Cart</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>

          <!-- CENTER LOGO (desktop only) -->
          <!-- CENTER LOGO (desktop only) -->
<div class="d-none d-lg-flex align-items-center justify-content-center flex-shrink-0"
     style="position: absolute; left: 50%; transform: translateX(-50%);">
  <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
    <img src="assets/classic2.png" alt="Logo" style="height: 14vh;"> <!-- increased from 6vh -->
    <span class="fw-bold" style="font-size: 16px;">ClassicCave</span>
  </a>
</div>
          <!-- RIGHT USER DROPDOWN -->
          <div class="d-flex align-items-center justify-content-end flex-grow-1">
            <?php if (isset($_SESSION['user_id'])): ?>
  <div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown"
      aria-expanded="false" style="font-size: 15px;">
      <?= htmlspecialchars($_SESSION['user_name']); ?>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
      <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <li><a class="dropdown-item" href="admin_dashboard.php">Admin Panel</a></li>
        <li><hr class="dropdown-divider"></li>
      <?php endif; ?>
      <li><a class="dropdown-item" href="my_orders.php">🧾 My Orders</a></li>
      <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
    </ul>
  </div>
<?php endif; ?>

          </div>

        </div>
      </div>
    </nav>
