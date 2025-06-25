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

// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";


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
