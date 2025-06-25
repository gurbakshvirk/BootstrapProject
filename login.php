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

<!-- Login Form -->
<form class="px-4 py-3 mt-5 pt-5" method="POST">
    <h2>Login</h2>
    <div class="mb-3">
        <label for="login_email" class="form-label">Email address</label>
        <input type="email" name="login_email" class="form-control" id="login_email" required>
    </div>
    <div class="mb-3">
        <label for="login_password" class="form-label">Password</label>
        <input type="password" name="login_password" class="form-control" id="login_password" required>
    </div>
    <button type="submit" name="login" class="btn btn-success">Login</button>
</form>