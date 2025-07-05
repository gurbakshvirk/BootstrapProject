<?php
session_start();
// if (!isset($_SESSION['status'])) {
//     $_SESSION['status'] === '0'; // or any default value you want
// }

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
  <header>
   <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom fixed-top">
  <div class="container-fluid">

    <!-- Logo for mobile view -->
    <div class="d-flex d-lg-none w-100 justify-content-center mb-2">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
        <img src="assets/classic2.png" alt="Logo" style="height: 5.5vh;">
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
      <div class="d-none d-lg-flex align-items-center justify-content-center flex-shrink-0"
        style="position: absolute; left: 50%; transform: translateX(-50%);">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
          <img src="assets/classic2.png" alt="Logo" style="height: 6vh;">
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
              <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
          </div>
        <?php else: ?>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false" style="font-size: 15px;">
              Support
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="login.php">Sign In</a></li>
              <li><a class="dropdown-item" href="signin.php">Register</a></li>
              <li><a class="dropdown-item" href="contact.php">Contact Us</a></li>
            </ul>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</nav>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/pexel.jpg" class="d-block w-100" alt="image1">
        </div>
        <div class="carousel-item">
          <img src="assets/shirts.jpg" class="d-block w-100" alt="image2">
        </div>
        <div class="carousel-item">
          <img src="assets/jeans.jpg" class="d-block w-100" alt="image3">
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
  <section class="about my-5">
    <div class="container ">


      <div class="text-center my-5">
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
       <!-- php for  trending products -->
     
       <div class="row gy-4">
        <?php while ($row3 = mysqli_fetch_assoc($result3)) { ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
            <div class="product-card w-100 d-flex flex-column">

              <div class="product-content">
                <img src="uploads/<?= $row3['images']; ?>" class="product-image img-fluid" alt="Product">
                <p class="product-title mt-2"><?= $row3['name']; ?></p>
                <p><?= $row3['small_description']; ?></p>


                <p>Original Price: ₹<?= $row3['original_price']; ?></p>
                <p>Selling Price: ₹<?= $row3['selling_price']; ?></p>
                <!-- <p>Quantity: <?= $row3['qty']; ?></p> -->
                <a href="view_single_product.php<?= $id['id']; ?>" class="btn btn-dark">Explore</a>
              </div>
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
      <!-- php for products -->
      <div class="d-flex overflow-auto flex-nowrap py-2">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
            <div class="product-card w-100">
              <div class="product-content">
                <img src="uploads/<?= $row['images']; ?>" class="product-image img-fluid" alt="Product">
                <p class="product-title mt-2"><?= $row['name']; ?></p>
                <p><?= $row['small_description']; ?></p>
                <p>Original Price: ₹<?= $row['original_price']; ?></p>
                <p>Selling Price: ₹<?= $row['selling_price']; ?></p>
                <!-- <p>Quantity: <?= $row['qty']; ?></p> -->
                <a href="single_product.php?id=<?= $row['id']; ?>" class="btn btn-dark">Explore</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    </div>
  </section>


  <!-- categories -->
  <section class="services">
    <div class="container">
      <div class="text-center my-5">
        <h1><span class="text-dark">Categories</span></h1>
        <hr class="w-25 m-auto">

      </div>
      <!-- php for categories -->
      <div class="row gy-4">
        <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
            <div class="product-card w-100">
              <div class="product-content">
                <img src="catuploads/<?= $row2['image']; ?>" class="product-image img-fluid" alt="Product">
                <p class="product-title mt-2"><?= $row2['name']; ?></p>
                <p><?= $row2['description']; ?></p>
                <!-- <p>Quantity: <?= $row2['qty']; ?></p> -->
                <a href="#" class="btn btn-dark">Explore</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    </div>
  </section>


  <!-- <div class="row mt-5" data-aos="zoom-in-down" data-aos-offset="200">
        <div class="col-sm-12 col-md-4 col-lg-4 col-12">
            <div class="card">
               <div class="card-body">
                <img src="assets/tshirts.jpg"style="width: 400px;" class="img-fluid" alt="image">
                <p class="card-text ">T-Shirts</p>
                <a href="#" class="btn btn-dark">Explore</a>
              </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 col-12">
             <div class="card">
              <div class="card-body">
                <img src="assets/brownleather.jpg"style="width: 400px;" class="img-fluid" alt="image">
                <p class="card-text ">Shoes</p>
                <a href="#" class="btn btn-dark">Explore</a>
              </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 col-12">
             <div class="card">
               <div class="card-body">
                <img src="assets/whitesneaker.jpg"style="width: 400px;" class="img-fluid" alt="image">
                <p class="card-text ">Air Jordans</p>
                <a href="#" class="btn btn-dark">Explore</a>
              </div>
            </div>
        </div>
    </div> -->





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

  <section class="contact py-5">
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
  </section>
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




  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>