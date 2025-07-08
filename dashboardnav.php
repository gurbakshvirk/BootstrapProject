<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
  <div class="container-fluid">

    <!-- Left links -->
    <div class="d-flex align-items-center">
      <ul class="navbar-nav me-3 d-flex flex-row gap-3 fs-5">
        <li class="nav-item">
          <a class="nav-link" href="index.php">User Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_view_wishlists.php">User Wishlists</a>
        </li>
      </ul>
    </div>

    <!-- Center logo -->
    <a class="navbar-brand mx-auto d-flex flex-column align-items-center" href="admin_dashboard.php">
      <img src="assets/classic2.png" style="height: 8vh; width: 8vh;">
      <span class="fw-bold">ClassicCave</span>
    </a>

    <!-- Right icons -->
    <div class="d-flex align-items-center gap-3">
      <div>Austria | INR ₹</div>
      <i class="bi bi-search" style="font-size: 1.2rem; cursor: pointer;"></i>
      <i class="bi bi-person" style="font-size: 1.2rem; cursor: pointer;"></i>
      <i class="bi bi-bag" style="font-size: 1.2rem; cursor: pointer;"></i>

      <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?>
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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