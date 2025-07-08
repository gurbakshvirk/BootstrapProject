<?php
require_once __DIR__ . '/vendor/autoload.php'; // Path to mPDF

$conn = mysqli_connect("localhost", "root", "", "CCBS");

if (!isset($_GET['order_id'])) {
    die("Invalid request.");
}

$order_id = intval($_GET['order_id']);

// Fetch order details
$order_sql = "SELECT * FROM orders WHERE id = $order_id";
$order = mysqli_fetch_assoc(mysqli_query($conn, $order_sql));

// Fetch order items
$item_sql = "SELECT oi.*, p.name 
             FROM order_items oi
             JOIN products p ON oi.product_id = p.id
             WHERE oi.order_id = $order_id";
$items = mysqli_query($conn, $item_sql);

// Build HTML for PDF
ob_start();
?>

<h2 style="text-align:center;">ClassicCave Clothing</h2>
<p style="text-align:center;">www.classiccave.com</p>
<hr>

<h3>Invoice #<?= $order_id ?></h3>
<p><strong>Date:</strong> <?= date('d M Y', strtotime($order['created_at'])) ?></p>
<p><strong>Customer:</strong> <?= htmlspecialchars($order['name']) ?></p>
<p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
<p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?>, <?= $order['city'] ?> - <?= $order['zip'] ?></p>
<p><strong>Payment:</strong> <?= $order['payment_method'] ?> (<?= $order['payment_status'] ?>)</p>
<p><strong>Status:</strong> <?= ucfirst($order['order_status']) ?></p>

<table border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price (₹)</th>
            <th>Subtotal (₹)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        while ($item = mysqli_fetch_assoc($items)) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price'], 2) ?></td>
                <td><?= number_format($subtotal, 2) ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="3" align="right"><strong>Total:</strong></td>
            <td><strong>₹<?= number_format($total, 2) ?></strong></td>
        </tr>
    </tbody>
</table>

<p style="text-align:center; margin-top: 40px;">Thank you for shopping with ClassicCave!</p>

<?php
$html = ob_get_clean();

// Generate PDF with mPDF
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle("Invoice_{$order_id}");
$mpdf->WriteHTML($html);
$mpdf->Output("Invoice_{$order_id}.pdf", \Mpdf\Output\Destination::DOWNLOAD); // Force download
exit;
?>
