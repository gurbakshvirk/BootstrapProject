<?php
require_once 'vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setClientId('YOUR_GOOGLE_CLIENT_ID');
$client->setClientSecret('YOUR_GOOGLE_CLIENT_SECRET');
$client->setRedirectUri('http://localhost/your_project/google-callback.php');

$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $google_oauth = new Google_Service_Oauth2($client);
    $user_info = $google_oauth->userinfo->get();

    $name = $user_info->name;
    $email = $user_info->email;
    $google_id = $user_info->id;

    // Connect to database
    $conn = new mysqli("localhost", "root", "", "CCBS");
    if ($conn->connect_error) {
        die("DB Error: " . $conn->connect_error);
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT id, name, email, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        // Insert new user with Google login
        $role = 'user';
        $stmt_insert = $conn->prepare("INSERT INTO users (name, email, password, cpassword, role, created_at) VALUES (?, ?, '', '', ?, NOW())");
        $stmt_insert->bind_param("sss", $name, $email, $role);
        $stmt_insert->execute();
        $user_id = $stmt_insert->insert_id;
        $stmt_insert->close();
    } else {
        // Get existing user ID
        $stmt->bind_result($user_id, $name, $email, $role);
        $stmt->fetch();
    }

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_role'] = $role;

    header("Location: index.php");
    exit();
}
