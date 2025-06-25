<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";


$conn = new mysqli($hostname, $username, $password);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


?>
<html>
  <?php include 'head.php';?>

<body>
<header>
<?php include 'user_files/user_components/user_navbar.php';?>
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
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</header>
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
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Everyday Essentials – Stay Cool, Walk Easy
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p>Discover the perfect balance of comfort and street-ready style with our men’s casual Clothes. Whether you're heading out for a coffee run or a weekend hangout, ClassicCave’s casual range keeps your vibe effortless and your steps light.

</p>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Sharp Looks Start at Your Feet – Premium Formal Menswear
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p>Make a strong impression with our range of men’s formal Clothes. Whether it's a business meeting or a wedding event, ClassicCave offers finely crafted leather Clothes and classic designs to complete your formal ensemble with class.</p>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Built For Classy – Men’s Clothes
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p>Take your performance to the next level with high-quality sports Clothes from ClassicCave. Designed for runners, gym-goers, and athletes, our collection combines breathable materials, great cushioning, and bold styles to keep you moving.</p>


          </div>
        </div>
      </div>
</div>

      </div>
      <div class="col-sm-12 col-md-6 col-lg-6 col-12 mt-3 text-end " data-aos="zoom-in" data-aos-offset="200">
        <img src="assets/newslide3.jpg" class="rightimg img-fluid img-thumbnail aboutimg" alt="Image">
      </div>
    </div>

  </div>
</section>


<section class="services">
  <div class="container">
    <div class="text-center my-5">
      <h1><span class="text-dark">Products</span></h1>
      <hr class="w-25 m-auto">
    </div>

    <div class="row" data-aos="zoom-in-up" data-aos-offset="200">
        <div class="col-sm-12 col-md-4 col-lg-4 col-12">
            <div class="card">
              <div class="card-body">
                <img src="assets/jeans.jpg" style="width: 400px;" class="img-fluid" alt="image">
                
                <p class="card-text ">Jeans</p>
                <a href="#" class="btn btn-dark">Explore</a>
              </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 col-12">
          
             <div class="card ">
               <div class="card-body">
                <img src="assets/suit.jpg"style="width: 400px;" class="img-fluid" alt="image">
                <p class="card-text ">Suits</p>
                <a href="#" class="btn btn-dark">Explore</a>
              </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 col-12">
             <div class="card">
               <div class="card-body">
                <img src="assets/shirt-tucked.jpg"style="width: 400px;" class="img-fluid" alt="image">
                <p class="card-text ">Shirts</p>
                <a href="#" class="btn btn-dark">Explore</a>
              </div>
            </div>
        </div>
    </div>




     <div class="row mt-5" data-aos="zoom-in-down" data-aos-offset="200">
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
    </div>
  </div>


  
</section>
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
      <label for="inputEmail4" class="form-label">Email  </label>
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
      <div class="col-sm-12 col-md-6 col-lg-6 col-12 m-auto text-end p-4"data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000">
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
          ClassicCave blends comfort with style to offer premium Menswear at affordable prices. Step into fashion with us!
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
