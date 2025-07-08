<?PHP
session_start();
$userid = $_SESSION['user_id']; // Make sure user is logged in
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ccbs";


$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$order_id = $_GET['order_id'];

// 1. Update order status
mysqli_query($conn, "UPDATE orders SET payment_status='paid', order_status='approved' WHERE id=$order_id");

// 2. Get cart items again
$cart_sql = "SELECT * FROM cart WHERE user_id = $userid";
$cart_result = mysqli_query($conn, $cart_sql);

// 3. Insert into order_items and update stock
while($row = mysqli_fetch_assoc($cart_result)) {
    $pid = $row['product_id'];
    $qty = $row['quantity'];
    $price = getProductPrice($pid); // write a helper function

    mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $pid, $qty, $price)");
    mysqli_query($conn, "UPDATE products SET qty = qty - $qty WHERE id = $pid");
}

// 4. Clear cart
mysqli_query($conn, "DELETE FROM cart WHERE user_id = $userid");

echo "Order placed successfully! Your order ID is: $order_id";
?>