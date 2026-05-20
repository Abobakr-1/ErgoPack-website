<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "ergopack");

// if (!isset($_GET['order_id'])) {
//     header("Location: home_page.php");
//     exit();
// }

// $order_id = $_GET['order_id'];

// $stmt = $con->prepare("SELECT * FROM orders WHERE O_ID = ?");
// $stmt->bind_param("i", $order_id);
// $stmt->execute();

// $result = $stmt->get_result();
// $order  = $result->fetch_assoc();

// if (!$order) {
//     header("Location: home_page.php");
//     exit();
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - ERGOPACK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
</head>
<body>

<?php include('navbar.php'); ?>

<main class="flex-grow-1">
<div class="container mt-5">

    <div class="text-center mb-4">
        <h2>🎉 Order Placed Successfully</h2>
        <p class="text-muted">Thank you for shopping with ERGOPACK!</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4" style="border-radius:15px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">

                <h5 style="color:#17548b;" class="mb-3">Order Details</h5>

               
                <p><b>Delivery Fee:</b> EGP <?php echo number_format($_SESSION['delivery_fee'], 2); ?></p>

                <p><b>Total:</b> EGP <?php echo number_format($_SESSION['grand_total'], 2); ?></p>

                <p><b>Payment Method:</b> <?php echo $_SESSION['payment_method']; ?></p>

                <p><b>Address:</b> <?php echo $_SESSION['delivery_address']; ?></p>

                <p><b>Status:</b> Pending</p>

                <p><b>Order Time:</b> <?php echo date("Y-m-d H:i:s"); ?></p>

                <a href="home_page.php" class="btn btn-primary mt-3 w-100">
                    Back to Home
                </a>

            </div>
        </div>
    </div>

</div>
</main>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>