<!DOCTYPE html>
<html>
<head>
    <title>Shoe Hut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Miniver&family=Poppins&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
</head>
<body>
    <header>
<?php include 'user_components/user_navbar.php';?>

</header>




</body>
<footer class="bg-dark text-light pt-4 mt-5 fixed-bottom">
  <div class="container">
    <div class="row text-center text-md-start">
      
      <!-- About Section -->
      <div class="col-md-4 mb-4">
        <h5>About ShoeHut</h5>
        <p class="small">
          ShoeHut blends comfort with style to offer premium footwear at affordable prices. Step into fashion with us!
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
        <p class="small"><i class="bi bi-envelope-fill me-2"></i> support@shoehut.in</p>
        <p class="small"><i class="bi bi-geo-alt-fill me-2"></i> New Delhi, India</p>
      </div>

    </div>

    <hr class="bg-light">

    <div class="text-center pb-3">
      <p class="mb-0 small">© 2025 ShoeHut. All rights reserved.</p>
    </div>
  </div>
</footer>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<!-- aos js -->
     <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
          <script>
              AOS.init();
          </script>
</body>
</html>