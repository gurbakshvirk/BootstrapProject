<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "CCBS");

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];
$orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders | ClassicCave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'indexnav.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">My Orders</h2>

    <?php if (mysqli_num_rows($orders) > 0): ?>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Total (₹)</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($orders)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= number_format($row['total_price'], 2) ?></td>
                    <td>
                        <span class="badge bg-<?= $row['payment_status'] === 'paid' ? 'success' : 'warning' ?>">
                            <?= ucfirst($row['payment_status']) ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-<?= $row['order_status'] === 'approved' ? 'primary' : ($row['order_status'] === 'cancelled' ? 'danger' : 'secondary') ?>">
                            <?= ucfirst($row['order_status']) ?>
                        </span>
                    </td>
                    <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                    <td>
                        <a href="my_order_details.php?order_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">View</a>

                        <?php if ($row['order_status'] === 'pending') { ?>
                            <a href="cancel_order.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm ms-2"
                               onclick="return confirm('Are you sure you want to cancel this order?');">
                               Cancel
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">You have not placed any orders yet.</div>
    <?php endif; ?>
</div>

</body>
</html>
