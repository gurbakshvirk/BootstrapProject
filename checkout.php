<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Please log in to proceed to checkout.";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout | ClassicCave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'indexnav.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>
    
    <form action="place_order.php" method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control" required pattern="[0-9]{10}" maxlength="10">
        </div>

        <div class="col-12">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" rows="2" required></textarea>
        </div>

        <div class="col-md-6">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" id="city" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="zip" class="form-label">Zip Code</label>
            <input type="text" name="zip" id="zip" class="form-control" required pattern="[0-9]{6}" maxlength="6">
        </div>

        <div class="col-md-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="COD">Cash on Delivery</option>
                <option value="Online">Online Payment</option>
                <option value="UPI">UPI Payment</option>
                <!-- You can add online payment options here -->
            </select>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">Place Order</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
