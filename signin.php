<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";


$conn = new mysqli($hostname, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// variables
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
if($password !== $cpassword){
    die("passwords do not match");}


$check_email_sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        die("❌ This email is already registered.");
    }
    $stmt->close();
    
$sql = "INSERT INTO `users` ( `name`, `email`, `password`, `cpassword`,`role`, `created_at`)
 VALUES ( '$name', '$email', '$password', '$cpassword', 'user', current_timestamp())";
//  mysqli_connect();

 if($conn->query($sql)==true){
  header("Location: login.php");
  exit();
 }
else{
  echo"error:sql<br> $conn->error";
}
$conn->close();
}
?>


<html>
<head>
    <title>Shoe Hut</title>
    <link rel="icon" type="image/x-icon" href="assets/logoshoe2.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Miniver&family=Poppins&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   
</head>
<body>
<header>
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
</header>

  <form class="px-4 py-3 mt-5 pt-5"name="form" method="POST">
    <div class="mb-3">
      <h1>Create Your Account</h1>
      <label for="email" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="Email1" placeholder="email@example.com">
    </div>
     <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Enter Your Name">
    </div>
    <div class="mb-3">
      <label for="Password1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="Password" placeholder="Password">
    </div>
   <div class="mb-3">
      <label for="Password1" class="form-label">Confirm Password</label>
      <input type="password" name="cpassword" class="form-control" id="cPassword" placeholder="Password">
    </div>
    



    <!-- <div class="mb-3"> -->




      <!-- <div class="form-check">
        <input type="checkbox" class="form-check-input" id="dropdownCheck">
        <label class="form-check-label" for="dropdownCheck">
          Remember me
        </label>
      </div> -->
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
  </form>


</body>
</html>
