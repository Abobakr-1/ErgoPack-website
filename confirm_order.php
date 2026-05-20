<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: mycart.php');
    exit;
}

if (!isset($_SESSION['delivery_address'])) {
    header('Location: checkout.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $con = mysqli_connect("localhost", "root", "", "ergopack");

    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $c_id        = $_SESSION['C_id'] ?? null;
    $subtotal    = $_SESSION['total'] ?? 0;
    $grand_total = $_SESSION['grand_total'] ?? 0;
    $fee         = $_SESSION['delivery_fee'] ?? 0;
    $address     = $_SESSION['delivery_address'] ?? '';
    $pay         = $_SESSION['payment_method'] ?? 'COD';
    $status      = 'Pending';
    $time        = date('Y-m-d H:i:s');

    $stmt = $con->prepare("
        INSERT INTO orders
        (C_id, O_subtotal_price, O_totalprice, O_status, Delivery_address, Delivery_fee, Delivery_time, pay_method)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "iddssdss",
        $c_id,
        $subtotal,
        $grand_total,
        $status,
        $address,
        $fee,
        $time,
        $pay
    );

    $stmt->execute();
    $order_id = $con->insert_id;

foreach($_SESSION['cart'] as $item){
    $pro_id = $item['Pro_id'];
    $qty    = $item['quantity'];
    $price  = $item['Pro_price'];
    $total  = $price * $qty;

    $item_stmt = $con->prepare("
        INSERT INTO order_items (O_ID, P_ID, O_quantity, O_price, O_total_price)
        VALUES (?, ?, ?, ?, ?)
    ");

    $item_stmt->bind_param("iiddd", $order_id, $pro_id, $qty, $price, $total);
    $item_stmt->execute();


    // ✅ ADD STOCK UPDATE HERE (THIS IS THE RIGHT PLACE)

    $stock_stmt = $con->prepare("
        UPDATE product 
        SET Pro_stock = Pro_stock - ? 
        WHERE Pro_id = ? AND Pro_stock >= ?
    ");

    $stock_stmt->bind_param("iii", $qty, $pro_id, $qty);
    $stock_stmt->execute();
}

    $_SESSION['cart'] = array();
    $_SESSION['cartItemCount'] = 0;

    unset($_SESSION['delivery_address']);
    unset($_SESSION['delivery_fee']);
    unset($_SESSION['grand_total']);
    unset($_SESSION['total']);
    unset($_SESSION['payment_method']);

    header('Location: success.php?order_id=' . $order_id);
    exit;
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order - ERGOPACK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
</head>

<body>

<?php include('navbar.php'); ?>

<main class="flex-grow-1">
<div class="container mt-5">

    <h2 class="mb-4">Confirm Your Order</h2>

    <div class="table-responsive mb-4">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($_SESSION['cart'] as $item):
                $subtotal = $item['Pro_price'] * $item['quantity'];
            ?>
                <tr>
                    <td>
                        <img src="<?php echo $item['Pro_image']; ?>"
                             style="height:70px; width:70px; object-fit:cover; border-radius:8px;">
                    </td>
                    <td><?php echo $item['Pro_name']; ?></td>
                    <td><?php echo $item['Pro_type']; ?></td>
                    <td>EGP <?php echo number_format($item['Pro_price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>EGP <?php echo number_format($subtotal, 2); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card p-4" style="border-radius:15px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">

                <h5 style="color:#17548b;" class="mb-3">Order Summary</h5>

                <p>
                    <b>Delivery Address:</b><br>
                    <?php echo $_SESSION['delivery_address']; ?>
                </p>

                <p>
                    <b>Payment Method:</b>
                    <?php echo $_SESSION['payment_method'] ?? 'COD'; ?>
                </p>

                <p>
                    <b>Subtotal:</b>
                    EGP <?php echo number_format($_SESSION['total'], 2); ?>
                </p>

                <p>
                    <b>Delivery Fee:</b>
                    EGP <?php echo number_format($_SESSION['delivery_fee'], 2); ?>
                </p>

                <h5 style="color:#17548b;">
                    <b>Total Price: EGP <?php echo number_format($_SESSION['grand_total'], 2); ?></b>
                </h5>

                <form method="POST" action="confirm_order.php">
                    <div class="d-flex gap-2 mt-3">
                        <a href="checkout.php" class="btn btn-secondary w-50">Go Back</a>
                        <button type="submit" class="btn btn-primary w-50">Place Order</button>
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