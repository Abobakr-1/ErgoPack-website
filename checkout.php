<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: mycart.php');
    exit;
}

if (!isset($_SESSION['C_id'])) {
    header('Location: customer_login.php?redirect=checkout');
    exit;
}

$total = $_SESSION['total'];
$delivery_fee = 90.00;
$grand_total  = $total + $delivery_fee;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['delivery_address'] = $_POST['address'];
    $_SESSION['payment_method']   = $_POST['payment_method'];
    $_SESSION['delivery_fee']     = $delivery_fee;
    $_SESSION['grand_total']      = $grand_total;
    header('Location: success.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ERGOPACK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
</head>
<body>

<?php include('navbar.php'); ?>

<main class="flex-grow-1">
<div class="container mt-5">

    <h2 class="mb-4">Checkout</h2>

    <div class="row">

<!-- ORDER SUMMARY -->
<div class="col-md-7 mb-4">
    <h5 style="color:#17548b;" class="mb-3">
        Order Summary
    </h5>

    <div class="table-responsive" style="margin-left:0; padding-left:0;">
        <table class="text-start" style="margin-left:0; width:100%;">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $item):
                    $subtotal = $item['Pro_price'] * $item['quantity'];
                ?>
                <tr>
                    <td>
                        <img src="<?php echo $item['Pro_image']; ?>"
                             style="height:60px; width:60px; object-fit:cover; border-radius:8px;">
                    </td>
                    <td><?php echo $item['Pro_name']; ?></td>
                    <td><?php echo $item['Pro_type']; ?></td>
                    <td>EGP <?php echo number_format($item['Pro_price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3" style="text-align:left;">
        <p><b>Subtotal:</b> EGP <?php echo number_format($total, 2); ?></p>
        <p><b>Delivery Fee:</b> EGP <?php echo number_format($delivery_fee, 2); ?></p>
        <h5 style="color:#17548b;">
            <b>Grand Total: EGP <?php echo number_format($grand_total, 2); ?></b>
        </h5>
    </div>
</div>
        <!-- DELIVERY FORM -->
        <div class="col-md-5">
            <h5 style="color:#17548b;" class="mb-3">Delivery Details</h5>
            <div class="card p-4" style="border-radius:15px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
                <form method="POST" action="checkout.php">
                    <div class="mb-3">
<label class="form-label fw-bold">Delivery Address</label>

<p class="form-control"
   style="height:40px; width:100%; padding-top:10px;">
   Your delivery address here
</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="" disabled selected>-- Select Payment Method --</option>
                            <option value="COD">Cash on Delivery (COD)</option>
                            <option value="credit_card">Credit Card</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="mycart.php" class="btn btn-secondary w-50">Back to Cart</a>
                        <button type="submit" class="btn btn-primary w-50">Continue</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
</main>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>