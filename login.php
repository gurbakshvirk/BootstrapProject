<?php
session_start();

// ✅ DATABASE CONNECTION
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";

// ✅ Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// ✅ Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    $login_sql = "SELECT id, name, email, password, role FROM users WHERE email = ?";
    $stmt = $conn->prepare($login_sql);
    $stmt->bind_param("s", $login_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $name, $email, $password_db, $role);
        $stmt->fetch();
        if ($login_password === $password_db) { // Use password_verify() if hashed
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_role'] = $role;
            if ($role == 'admin') {
                header("Location: index.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            echo "<div class='alert alert-danger'>Invalid password.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>No account found with that email.</div>";
    }
    $stmt->close();
}
?>
      <!-- <div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label>
        <a href="#">Forgot Password</a>
      </div> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassisCave</title>
    <style>
    *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body{
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: url(assets/Image.jpg) no-repeat;
  background-size: cover;
  background-position: center;
}
.wrapper{
  width: 620px;
  background: transparent;
  border: 2px solid rgba(255, 255, 255, .2);
  backdrop-filter: blur(9px);
  color:white;
  border-radius: 12px;
  padding: 30px 40px;
}
.wrapper h1{
  font-size: 36px;
  text-align: center;
}
.wrapper .input-box{
  position: relative;
  width: 100%;
  height: 50px;
  padding-bottom: 20px;
  margin: 30px 0;
}
.input-box input{
  width: 100%;
  height: 100%;
  background: transparent;
  border: none;
  outline: none;
  border: 2px solid rgba(255, 255, 255, .2);
  border-radius: 40px;
  font-size: 16px;
  color: #fff;
  padding: 20px 45px 20px 20px;
}
.form-label{
  font-size: 24px;
}
.input-box input::placeholder{
  color: #fff;
}
.input-box i{
  position: absolute;
  right: 20px;
  top: 85%;
  transform: translate(-50%);
  font-size: 20px;

}
.wrapper .remember-forgot{
  display: flex;
  justify-content: space-between;
  font-size: 14.5px;
  margin: -15px 0 15px;
}
.remember-forgot label input{
  accent-color: #fff;
  margin-right: 3px;

}
.remember-forgot a{
  color: #fff;
  text-decoration: none;

}
.remember-forgot a:hover{
  text-decoration: underline;
}
.wrapper .btn{
  width: 100%;
  height: 45px;
  background: #fff;
  border: none;
  outline: none;
  border-radius: 40px;
  box-shadow: 0 0 10px rgba(0, 0, 0, .1);
  cursor: pointer;
  font-size: 16px;
  color: #333;
  font-weight: 600;
}
.wrapper .register-link{
  font-size: 14.5px;
  text-align: center;
  margin: 20px 0 15px;

}
.register-link p a{
  color: #fff;
  text-decoration: none;
  font-weight: 600;
}
.register-link p a:hover{
  text-decoration: underline;
}
.back {
  position: absolute; 
    top: 20px;
    left: 20px;
    background-color:rgba(248, 249, 250, 0.68);
    /* background: transparent; */

    border: none;
    padding: 10px 20px;
    font-size: 16px;

    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* .input-box i {
  position: absolute;
  top: 50%;
  right: 15px;
  transform: translateY(-50%);
  font-size: 20px;
  color: #fff;
  pointer-events: none;
}
.input-box input {
  padding: 10px 45px 10px 20px; 
} */

   </style>
</head>
<body>
 <div class="login-container">
<button class="back">
    <a href="index.php" style="text-decoration: none; color: black;">Back to Home</a>
</button>

     <!-- Login Form -->
    <div class="wrapper">
    <form class="px-4 py-3 mt-5 pt-3" method="POST">
        <h1>Login</h1>
        <div class="input-box mb-3">
            <label for="login_email" class="form-label">Email address</label>
            <input type="email" name="login_email" class="form-control" id="login_email" placeholder="Enter registered email" required><i class='bx bxs-user'></i>
        </div>
        <div class=" input-box mb-3">
            <label for="login_password" class="form-label">Password</label>
            <input type="password" name="login_password" class="form-control" id="login_password" placeholder="Enter your password" required><i class='bx bxs-lock-alt' ></i>
        </div>
        <button type="submit" name="login" class="btn btn-success">Login</button>
    </form>
    </div>
</div>
    




<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</body>
</html>