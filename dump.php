    INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `popular`, `image`, `created_at`) 
    
    
    VALUES (NULL, 'Jeans', 'Jeans', 'Jeans best ', 'Jeans', 'Jeans', 'Jeans', '1', '1', '1750951232.jpg', '2025-06-26 20:50:32');
else{
 echo"connection okayy";
}

if(!isset($_GET['id'])){
    $_SESSION['message'] = "Invalid Category ID";
    header("Location: added_categories.php");
    exit();
}

$category_id = $_GET['id'];
$sql = "SELECT * FROM categories WHERE id = '$category_id'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) !== 1 ){
    $_SESSION['message'] = "Category not found";
    header("location: added_categories.php");
    exit();
}
$category = mysqli_fetch_assoc($result);

handle update submission
if(isset($_POST['update_category'])){
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $popular = isset($_POST['popular']) ? '1' : '0';
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];



    Handle image upload
    $image = $_FILES['image']['name'];
    if(!empty($image)){
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;
        $upload_path = "catuploads/" . $filename;
       move_uploaded_file($image_tmp, $upload_path);
    }else{
        $filename = $_POST['image']; // Keep the old image if no new image is uploaded
    }
    $update_query = "UPDATE categories SET
        // -- category_id = '$category_id',
        // name = '$name',
        // slug = '$slug',
        // description = '$description',
        // image = '$filename',
        // status = '$status',
        // popular = '$popular',
        // meta_title = '$meta_title',
        // meta_keywords = '$meta_keywords',
        // meta_description = '$meta_description'
        // WHERE id = '$category_id'";
 //
    // Redirect to the categories page with a success message
    // $_SESSION['message'] = "Category Updated Successfully";
    // header("Location: added_categories.php");
    // exit();
    
    // }





    <!-- old navbar --> of admin dashboard
         <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
  <div class="container-fluid ">
    <a class="navbar-brand fs-6 d-flex align-items-center" href="admin_dashboard.php">
  <img src="assets/classic2.png" style="height: 8vh; width: 8vh;">
  <span style="display:inline-block; width:auto; height:auto; margin-left: 5px;">ClassicCave</span>
</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5 text-end">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">User Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_view_wishlists.php">User Wishlists</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li> -->
<!-- <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?> -->
  <!-- <li class="nav-item">
    <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
  </li> -->
  <!-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Products
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="add_product.php">Add Product</a></li>
      <li><a class="dropdown-item" href="added_products.php">View Products</a></li>
    </ul>
  </li> -->
  <!-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Categories</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="add_categories.php">Add Category</a></li>
      <li><a class="dropdown-item" href="added_categories.php">View Categories</a></li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="orders.php">Orders Management</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="messages.php">Customer Messages</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="users.php">User Management</a>
  </li> -->
  <!-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Reports</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="sales_report.php">Sales Reports</a></li>
      <li><a class="dropdown-item" href="stock_alerts.php">Stock Alerts</a></li>
      <li><a class="dropdown-item" href="performance.php">Performance Analytics</a></li>
    </ul>
  </li> -->
  <!-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <?= ($_SESSION['user_name']); ?>
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
    </ul>
  </li>
<?php endif; ?>


       
      </ul>
    </div>
  </div> -->
<!-- </nav> --> 





navbar of index page
 <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
      <div class="container-fluid ">
        <a class="navbar-brand fs-6 d-flex align-items-center" href="index.php">
          <img src="assets/classic2.png" style="height: 8vh; width: 8vh;">
          <span style="display:inline-block; width:auto; height:auto; margin-left: 5px;">ClassicCave</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <a class="nav-link" href="wishlist.php">Wishlist</a>
            </li>
            <li class="nav-item">
              <?php if (isset($_SESSION['user_id'])): ?>
                <a class="nav-link" href="cart.php?id=<?= $_SESSION['user_id'] ?>">Cart</a>
              <?php endif; ?>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <?= ($_SESSION['user_name']); ?>
                </a>
                <ul class="dropdown-menu">
                  <!-- <li><a class="dropdown-item" href="profile.php">Profile</a></li> -->
                  <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <li><a class="dropdown-item" href="admin_dashboard.php">Admin Panel</a></li>
                  <?php endif; ?>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                </ul>
              </li>
            <?php else: ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
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