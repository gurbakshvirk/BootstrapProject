<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ccbs";

$conn = new mysqli($hostname, $username, $password, $dbname);
$sql = "select * from products where status='1'";
$sql2 = "select * from categories where status='1'";
$sql3 = "SELECT * FROM products WHERE trending='1'";
// $_GET = $user_id('id');

// $sql2 = "SELECT * FROM categories WHERE status='1'";
$result = mysqli_query($conn, $sql);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result2 = mysqli_query($conn, $sql2);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result3 = mysqli_query($conn, $sql3);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
// <?php
// session_start();
// $hostname = "localhost";
// $username = "root";
// $password = "";
// $dbname =  "ccbs";

$status = isset($_POST['status']) ? '1' : '0';
$trending = isset($_POST['trending']) ? '1' : '0';
// $conn = new mysqli($hostname, $username, $password , $dbname);




// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

?>
<html>

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
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 border-bottom fixed-top" style="height: 70px;">
      <div class="container-fluid">

        <!-- Mobile Logo -->
        <div class="d-flex d-lg-none w-100">
          <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="assets/classic2.png" alt="Logo" style="height: 10vh;">
          </a>
        </div>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse w-100" id="navbarContent">
          <!-- LEFT LINKS -->
          <div class="d-flex align-items-center justify-content-start flex-grow-1">
            <ul class="navbar-nav flex-row flex-lg-row flex-column gap-3 gap-lg-3" style="font-size: 15px;">
              <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
              <?php
              // navbar.php or wherever you include the navbar
              $hostname = "localhost";
              $username = "root";
              $password = "";
              $dbname = "ccbs";

              $conn = new mysqli($hostname, $username, $password, $dbname);
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              // Fetch active categories
              $cat_query = "SELECT * FROM categories WHERE status = 1 ORDER BY name ASC";
              $cat_result = mysqli_query($conn, $cat_query);
              ?>

              <!-- <li class="nav-item"></li> -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                  <?php while ($row = mysqli_fetch_assoc($cat_result)) { ?>
                    <li><a class="dropdown-item"
                        href="category.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
                  <?php } ?>
                </ul>
              </li>

              <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>

              <li class="nav-item"><a class="nav-link" href="wishlist.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
</svg>Wishlist</a></li>
              <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link" href="cart.php?id=<?= $_SESSION['user_id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg>Cart</a></li>
              <?php endif; ?>
            </ul>
          </div>


          <!-- CENTER LOGO (Desktop Only) -->
          <div class="d-none d-lg-flex align-items-center justify-content-center flex-shrink-0"
            style="position: absolute; left: 50%; transform: translateX(-50%);">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
              <img src="assets/classic2.png" alt="Logo" style="height: 16vh;">
            </a>
          </div>



          <!-- SEARCH BAR -->

          <!-- RIGHT USER DROPDOWN -->
          <div class="d-flex align-items-center justify-content-end flex-grow-1">
            <?php if (isset($_SESSION['user_id'])): ?>
              <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>
                  <?= htmlspecialchars($_SESSION['user_name']); ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <li><a class="dropdown-item" href="admin_dashboard.php">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg> Admin Panel</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                  <?php endif; ?>
                  <li><a class="dropdown-item" href="my_orders.php">🧾 My Orders</a></li>
                  <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                </ul>
              </div>
            <?php else: ?>
              <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="guestDropdown" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Account
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                  <li><a class="dropdown-item" href="login.php">Login</a></li>
                  <li><a class="dropdown-item" href="register.php">Create Account</a></li>
                </ul>
              </div>
            <?php endif; ?>

          </div>
        </div>
      </div>

    </nav>
    <!-- Carousel -->


    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/pexel.jpg" class="d-block w-100" alt="image1">
        </div>
        <div class="carousel-item">
          <img src="assets/shirts.jpg" class="d-block w-100" alt="image2">
        </div>
        <div class="carousel-item">
          <img src="assets/slide3.jpg" class="d-block w-100" alt="image3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  </header>

  <!-- about and right side image -->
  <section class="about my-2">
    <div class="container ">


      <div class="text-center my-4">
        <h1 data-aos="fade-up" data-aos-offset="100">Welcome to<span class="text-primary"> ClassicCave</span></h1>
        <hr class="w-25 m-auto">
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-12 p-2" data-aos="zoom-in" data-aos-offset="200">
          <h1>What do you <span class="text-dark">want to know??</span></h1>
          <p class="p-2 para">
            "Step into style and comfort with our latest collection of Clothes.
            Whether you're heading to the office, hitting the gym, or just out for a stroll,
            we’ve got the perfect pair for every step you take. Discover quality, durability,
            and fashion — all in one place."
          </p>



          <button type="button" class="btn btn-light mb-5 explore-btn">Explore More</button>




          <div class="accordion" id="accordionExample" data-aos="zoom-in-left " data-aos-offset="200">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                  aria-expanded="true" aria-controls="collapseOne">
                  Everyday Essentials – Stay Cool, Walk Easy
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Discover the perfect balance of comfort and street-ready style with our men’s casual Clothes.
                    Whether you're heading out for a coffee run or a weekend hangout, ClassicCave’s casual range keeps
                    your vibe effortless and your steps light.

                  </p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Sharp Looks Start at Your Feet – Premium Formal Menswear
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Make a strong impression with our range of men’s formal Clothes. Whether it's a business meeting or
                    a wedding event, ClassicCave offers finely crafted leather Clothes and classic designs to complete
                    your formal ensemble with class.</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Built For Classy – Men’s Clothes
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Take your performance to the next level with high-quality sports Clothes from ClassicCave. Designed
                    for runners, gym-goers, and athletes, our collection combines breathable materials, great
                    cushioning, and bold styles to keep you moving.</p>


                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- right side image -->
        <div class="col-sm-12 col-md-6 col-lg-6 col-12 mt-3 text-end " data-aos="zoom-in" data-aos-offset="200">
          <img src="assets/newslide3.jpg" class="rightimg img-fluid img-thumbnail aboutimg" alt="Image">
        </div>
      </div>

    </div>
  </section>

  <!-- trending products -->

  <section class="services">
    <div class="container">
      <div class="text-center my-5">
        <h1><span class="text-dark">Trending Products</span></h1>
        <hr class="w-25 m-auto">
      </div>

      <!-- Owl Carousel for Trending Products -->
      <div class="owl-carousel trending-carousel owl-theme">
        <?php while ($row3 = mysqli_fetch_assoc($result3)) { ?>
          <div class="item">
            <!-- <div class="product-card d-flex flex-column h-100"> -->
            <div class="product-card w-100 d-flex flex-column">
              <!-- <div class="product-content text-center p-2"> -->
              <?php
              $product_id = $row3['id'];
              $image_sql = "SELECT image_path FROM product_images WHERE product_id = $product_id LIMIT 1";
              $image_result = mysqli_query($conn, $image_sql);
              $image = mysqli_fetch_assoc($image_result);
              $image_path = $image ? 'uploads/' . $image['image_path'] : 'assets/default.jpg';
              ?>
              <img src="<?= $image_path ?>" class="product-image img-fluid" alt="<?= $row3['name']; ?>">

              <p class="product-title mt-2"><?= $row3['name']; ?></p>
              <!-- <p><?= $row3['small_description']; ?></p> -->
              <!-- <p><?= $row3['original_price']; ?> ₹<?= $row3['selling_price']; ?></p> -->
              <p class="product-price text-dark mb-1">
                ₹<?= $row3['selling_price']; ?>
                <del class="original-price text-secondary small">₹<?= $row3['original_price']; ?></del>
              </p>
              <a href="single_product.php?id=<?= $row3['id']; ?>" class="btn btn-outline-dark">Explore</a>
              <!-- </div> -->

            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    </div>
  </section>
  <!-- Products -->
  <section class="services">
    <div class="container">
      <div class="text-center my-5">
        <h1><span class="text-dark">Products</span></h1>
        <hr class="w-25 m-auto">
      </div>
      <?php if (mysqli_num_rows($result) > 0) { ?>
        <div class="owl-carousel products-carousel owl-theme">
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="item">
              <div class="product-card w-100 d-flex flex-column">
                <!-- <div class="product-content text-center p-2"> -->
                  <?php
                  $product_id = $row['id'];
                  $image_sql = "SELECT image_path FROM product_images WHERE product_id = $product_id LIMIT 1";
                  $image_result = mysqli_query($conn, $image_sql);
                  $image = mysqli_fetch_assoc($image_result);
                  $image_path = $image ? 'uploads/' . $image['image_path'] : 'assets/default.jpg';
                  ?>
                  <img src="<?= $image_path ?>" class="product-image img-fluid" alt="<?= $row['name']; ?>">
                  <p class="product-title mt-2"><?= $row['name']; ?></p>
                  <!-- <p><?= $row['small_description']; ?></p> -->
                  <p class="product-price text-dark mb-1 ">
                    ₹<?= $row['selling_price']; ?>
                    <del class="original-price text-secondary small">₹<?= $row['original_price']; ?></del>
                  </p>
                  <a href="single_product.php?id=<?= $row['id']; ?>" class="btn btn-outline-dark">Explore</a>
                <!-- </div> -->
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } else {
        echo "<p>No products found.</p>";
      } ?>

      <div class="text-center mt-4">
        <a href="products.php" class="btn btn-outline-dark">View All Products</a>
      </div>
    </div>
  </section>

  <!-- Reviews -->
  <section class="team my-5 text-center">
    <div class="container">
      <div class="text-center my-5" data-aos="zoom-in" data-aos-offset="200">
        <h1>Customer <span class="text-dark">Reviews</span></h1>
        <hr class="w-25 m-auto">
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4 col-12">
          <div class="card" data-aos="zoom-in-left" data-aos-offset="200">
            <div class="card-body">
              <img src="assets/image1.jpg" class="img-fluid rounded-circle border border-dark p-2" alt="image">
              <h5 class="card-title mt-2">Andrew</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-dark">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 col-12">
          <div class="card" data-aos="zoom-in-up" data-aos-offset="200">
            <div class="card-body">
              <img src="assets/image2.jpg" class="img-fluid rounded-circle border border-dark p-2" alt="image">
              <h5 class="card-title mt-2">Sam</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-dark">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 col-12">
          <div class="card" data-aos="zoom-in-right" data-aos-offset="200">
            <div class="card-body">
              <img src="assets/image3.jpg" class="img-fluid rounded-circle border border-dark p-2" alt="image">
              <h5 class="card-title mt-2">Leo</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-dark">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- <section class="contact py-5">
    <div class="container">
      <div class="text-center my-5">
        <h1>Create Your<span class="text-dark"> Account now</span></h1>
        <hr class="w-25 m-auto">
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-12" data-aos="zoom-out-down" data-aos-offset="150">
          <form class="row g-3">
            <div class="col-md-6 tooltipclass">
              <label for="inputEmail4" class="form-label">Email </label>
              <input type="email" class="form-control" id="inputEmail4">
              <span class="tooltiptext">Enter your Email</span>
            </div>
            <div class="col-md-6 tooltipclass">
              <label for="inputPassword4" class="form-label">Password</label>
              <input type="password" class="form-control" id="inputPassword4">
              <span class="tooltiptext">Enter your Password</span>
            </div>
            <div class="col-12 tooltipclass">
              <label for="inputAddress" class="form-label">Address</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="">
              <span class="tooltiptext">Enter your Address</span>
            </div>
            <div class="col-md-6 tooltipclass">
              <label for="inputCity" class="form-label">City</label>
              <input type="text" class="form-control" id="inputCity">
              <span class="tooltiptext">Enter your City</span>
            </div>
            <div class="col-md-4 tooltipclass">
              <label for="inputState" class="form-label">State</label>
              <span class="tooltiptext">Choose State</span>
              <select id="inputState" class="form-select">

                <option selected>Choose...</option>

                <option>...</option>

              </select>
            </div>
            <div class="col-md-2 tooltipclass">
              <label for="inputZip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="inputZip"></input>
              <span class="tooltiptext">Enter your Zip Code</span>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                  Check me out
                </label>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-dark">Sign in</button>
            </div>
          </form>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-12 m-auto text-end p-4" data-aos="flip-left"
          data-aos-easing="ease-out-cubic" data-aos-duration="2000">
          <img src="assets/Image.jpg" class="img-fluid img-thumbnail p-2" alt="">
        </div>
      </div>
    </div>
  </section> -->
  <footer class="bg-dark text-light pt-4 mt-5">
    <div class="container">
      <div class="row text-center text-md-start">

        <!-- About Section -->
        <div class="col-md-4 mb-4">
          <h5>About ClassicCave</h5>
          <p class="small">
            ClassicCave blends comfort with style to offer premium Menswear at affordable prices. Step into fashion with
            us!
          </p>
        </div>

        <!-- Quick Links -->
        <div class="col-md-4 mb-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="about.php" class="text-light text-decoration-none">About</a></li>
            <li><a href="contact.php" class="text-light text-decoration-none">Support</a></li>
            <li><a href="products.php" class="text-light text-decoration-none">Products</a></li>
            <li><a href="cart.php" class="text-light text-decoration-none">Cart</a></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div class="col-md-4 mb-4">
          <h5>Contact Us</h5>
          <p class="small"><i class="bi bi-telephone-fill me-2"></i> +91 98765 43210</p>
          <p class="small"><i class="bi bi-envelope-fill me-2"></i> support@ClassicCave.in</p>
          <p class="small"><i class="bi bi-geo-alt-fill me-2"></i> New Delhi, India</p>
        </div>

      </div>

      <hr class="bg-light">

      <div class="text-center pb-3">
        <p class="mb-0 small">© 2025 ClassicCave. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- jQuery (must be before Owl Carousel) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Owl Carousel -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <!-- Your custom init script -->
  <script>
    $(document).ready(function () {
      $(".trending-carousel").owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplay: false, // you said no autoplay
        responsive: {
          0: { items: 1 },
          576: { items: 2 },
          768: { items: 3 },
          992: { items: 4 }
        }
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $('.products-carousel').owlCarousel({
        loop: true,
        margin: 20,
        // nav: true,
        // dots: true,
        autoplay: false,              // ✅ Enable autoplay
        autoplayTimeout: 1500,       // ✅ Delay in milliseconds (3000ms = 3s)
        autoplayHoverPause: true,   // ✅ Pause on hover
        responsive: {
          0: { items: 1 },
          576: { items: 2 },
          768: { items: 3 },
          992: { items: 4 }
        }
      });
    });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>