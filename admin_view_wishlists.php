<?php
session_start();

// Optional: Only allow admin
// if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
//     header("Location: login.php");
//     exit();
// }

$conn = new mysqli("localhost", "root", "", "CCBS");

$sql = "SELECT wishlist.*, users.name AS user_name, products.name AS product_name, products.images 
        FROM wishlist
        JOIN users ON wishlist.user_id = users.id
        JOIN products ON wishlist.product_id = products.id
        ORDER BY wishlist.added_on DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - View All Wishlists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 30px; background: #f4f4f4; }
        table { background: #fff; border-radius: 10px; overflow: hidden; }
        img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; }
    </style>
</head>
<body>


<?php
include 'dashboardnav.php'
?>

<div class="container  mt-5 pt-5">
    <h2 class="mb-4">🧡 All Wishlists (Admin View)</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Product</th>
                <th>Image</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['user_name']); ?></td>
                    <td><?= htmlspecialchars($row['product_name']); ?></td>
                    <td><img src="uploads/<?= $row['images']; ?>" alt="<?= $row['product_name']; ?>"></td>
                    <td><?= date("d M Y, h:i A", strtotime($row['added_on'])); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No wishlist entries found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
