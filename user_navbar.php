<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
  <div class="container-fluid ">
    <a class="navbar-brand fs-6 d-flex align-items-center" href="..//index.php">
 <img src="assets/classic2.png" style="height: 8vh; width: 8vh;">
  <span style="display:inline-block; width:auto; height:auto; margin-left: 5px;">ClassicCave</span>
</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5 text-end">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>
<?php if (isset($_SESSION['user_id'])): ?>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <?=($_SESSION['user_name']); ?>
    </a>
    <ul class="dropdown-menu">
      <!-- <li><a class="dropdown-item" href="profile.php">Profile</a></li> -->
      <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <li><a class="dropdown-item" href="admin_dashboard.php">Admin Panel</a></li>
      <?php endif; ?>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
    </ul>
  </li>
<?php else: ?>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Support
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="login.php">Sign In</a></li>
      <li><a class="dropdown-item" href="signin.php">Register</a></li>
      <li><a class="dropdown-item" href="contact.php">Contact Us</a></li>
    </ul>
  </li>
<?php endif; ?>

       
      </ul>
    </div>
  </div>
</nav>