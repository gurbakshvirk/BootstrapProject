<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ccbs";
$conn = new mysqli($hostname, $username, $password, $dbname);
$sql = "SELECT id, name, qty FROM products ORDER BY qty ASC";
$result = $conn->query($sql);




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inventory Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
  <div class="container">
    <h2 class="mb-4">Inventory Management</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Stock Quantity</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['qty'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
