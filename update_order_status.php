<?php
$conn = mysqli_connect("localhost", "root", "", "CCBS");

if (isset($_GET['id']) && isset($_GET['status'])) {
    $order_id = intval($_GET['id']);
    $new_status = $_GET['status'];

    $sql = "UPDATE orders SET order_status = '$new_status' WHERE id = $order_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_orders.php?message=updated");
        exit();
    } else {
        echo "Failed to update order.";
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>  