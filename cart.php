<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";

$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Please log in to view your cart.";
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.*, products.name, products.images, products.selling_price 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = $user_id";

$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Your Cart | ClassicCave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'indexnav.php';
    ?>
    <div class="container mt-5">
        <h2 class="mb-4">Your Shopping Cart</h2>

        <?php if (mysqli_num_rows($query) > 0): ?>
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price (₹)</th>
                        <th>Quantity</th>
                        <th>Subtotal (₹)</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    while ($row = mysqli_fetch_assoc($query)):
                        $subtotal = $row['selling_price'] * $row['quantity'];
                        $total += $subtotal;
                        ?>
                        <tr>
                            <td>
                                <?php
                                $product_id = $row['product_id']; // Ensure correct ID is used
                                $image_sql = "SELECT image_path FROM product_images WHERE product_id = $product_id LIMIT 1";
                                $image_result = mysqli_query($conn, $image_sql);
                                $image = mysqli_fetch_assoc($image_result);
                                $image_path = $image ? 'uploads/' . $image['image_path'] : 'assets/default.jpg';
                                ?>
                                <img src="<?= htmlspecialchars($image_path); ?>" alt="<?= htmlspecialchars($row['name']); ?>"
                                    width="70">
                            </td>
                            <!-- <img src="<?= htmlspecialchars($image_path); ?>" alt="<?= htmlspecialchars($row['name']); ?>" width="70"> </td>  -->
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= $row['selling_price']; ?></td>
                            <td>
                                <div class="input-group justify-content-center" style="max-width: 120px; margin:auto;">
                                    <button class="btn btn-sm btn-outline-secondary updateQtyBtn" data-type="decrement"
                                        data-id="<?= $row['product_id']; ?>">−</button>
                                    <input type="text" class="form-control form-control-sm text-center qtyInput"
                                        value="<?= $row['quantity']; ?>" data-id="<?= $row['product_id']; ?>" readonly>
                                    <button class="btn btn-sm btn-outline-secondary updateQtyBtn" data-type="increment"
                                        data-id="<?= $row['product_id']; ?>">+</button>
                                </div>
                            </td>

                            <td><?= $subtotal; ?></td>
                            <td>
                                <button class="btn btn-sm btn-danger deleteItemBtn"
                                    data-id="<?= $row['product_id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg></button>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                    <tr class="table-secondary fw-bold">
                        <td colspan="4">Total</td>
                        <td>₹<?= $total; ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="checkout.php" class="btn btn-success mt-3">Proceed to Checkout</a>

        <?php else: ?>
            <p class="alert alert-warning">Your cart is empty.</p>
        <?php endif; ?>

        <a href="products.php" class="btn btn-primary mt-3">Continue Shopping</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".updateQtyBtn").click(function () {
                var productId = $(this).data("id");
                var actionType = $(this).data("type");
                var qtyInput = $('.qtyInput[data-id="' + productId + '"]');
                var currentQty = parseInt(qtyInput.val());

                // Prevent qty going below 1
                if (actionType === "decrement" && currentQty <= 1) return;

                var newQty = (actionType === "increment") ? currentQty + 1 : currentQty - 1;

                // AJAX request
                $.ajax({
                    url: "update_cart_quantity.php",
                    method: "POST",
                    data: {
                        product_id: productId,
                        quantity: newQty
                    },
                    success: function (response) {
                        if (response == "success") {
                            qtyInput.val(newQty);
                            location.reload(); // refresh the page to update totals
                        } else {
                            alert("Failed to update quantity.");
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            // Existing qty increment/decrement remains here...

            // ❌ DELETE BUTTON
            $(".deleteItemBtn").click(function () {
                var productId = $(this).data("id");

                if (confirm("Are you sure you want to remove this item from cart?")) {
                    $.ajax({
                        url: "delete_cart_item.php",
                        method: "POST",
                        data: {
                            product_id: productId
                        },
                        success: function (response) {
                            if (response == "success") {
                                location.reload(); // refresh cart page
                            } else {
                                alert("Failed to delete item.");
                            }
                        }
                    });
                }
            });

        });
    </script>


</body>

</html>