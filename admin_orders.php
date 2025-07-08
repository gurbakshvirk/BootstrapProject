<?php
$conn = mysqli_connect("localhost", "root", "", "CCBS");
$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 30px;
            background-color: #f8f9fa;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        h2 {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📦 All Orders</h2>

    <?php if (isset($_GET['message']) && $_GET['message'] == 'updated') : ?>
        <div class="alert alert-success">Order status updated successfully.</div>
    <?php endif; ?>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Total (₹)</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($order = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['user_id'] ?></td>
                <td><?= htmlspecialchars($order['name']) ?></td>
                <td>₹<?= $order['total_price'] ?></td>
                <td><?= ucfirst($order['payment_method']) ?> <br><small class="text-muted">(<?= $order['payment_status'] ?>)</small></td>
                <td>
                    <?php
                        $status = ucfirst($order['order_status']);
                        $color = $order['order_status'] === 'approved' ? 'success' :
                                 ($order['order_status'] === 'rejected' ? 'danger' : 'secondary');
                    ?>
                    <span class="badge bg-<?= $color ?>"><?= $status ?></span>
                </td>
                <td>
                    <!-- View Details Button -->
                    <a href="admin_view_order_details.php?order_id=<?= $order['id'] ?>" class="btn btn-info btn-sm mb-1">View</a>

                    <!-- Approve/Reject -->
                    <?php if ($order['order_status'] === 'pending') { ?>
                        <a href="update_order_status.php?id=<?= $order['id'] ?>&status=approved" class="btn btn-success btn-sm mb-1">Approve</a>
                        <a href="update_order_status.php?id=<?= $order['id'] ?>&status=rejected" class="btn btn-danger btn-sm mb-1">Reject</a>
                    <?php } elseif ($order['order_status'] === 'approved') { ?>
                        <!-- Download Invoice -->
                        <a href="generate_invoice.php?order_id=<?= $order['id'] ?>" class="btn btn-warning btn-sm" target="_blank">Download Invoice</a>
                    <?php } else { ?>
                        <span class="text-muted">No actions</span>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
