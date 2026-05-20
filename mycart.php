<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['quantity'] * $item['Pro_price'];
}
$_SESSION['total'] = $total;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - ERGOPACK</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css.css">
</head>
<body>

<?php include('navbar.php'); ?>

<main class="flex-grow-1">
<div class="container mt-5">

<h2 class="mb-4">My Cart</h2>

<?php if (empty($_SESSION['cart'])): ?>

<div class="text-center py-5">
    <h4 style="color:#6b89a8;">Your cart is empty</h4>
<p class="text-muted text-center mt-3">
    Go back and explore <a href="adult.php" style="color: black;text-decoration:none;font-weight:500;">products</a>
</p>
</div>

<?php else: ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($_SESSION['cart'] as $id => $item):
                $subtotal = $item['Pro_price'] * $item['quantity'];
            ?>
                <tr>
                    <td>
                    <img src="<?php echo $item['Pro_image']; ?>"
                    style="height:80px; width:80px; object-fit:cover; border-radius:8px;">
                    </td>
                    <td><?php echo $item['Pro_name']; ?></td>
                    <td><?php echo $item['Pro_type']; ?></td>
                    <td><?php echo $item['Pro_description']; ?></td>
                    <td>EGP <?php echo number_format($item['Pro_price'], 2); ?></td>
<td>

    <div class="d-flex align-items-center justify-content-center gap-2">

        <a href="update_cart.php?action=decrease&id=<?php echo $id; ?>"
           class="btn btn-outline-secondary btn-sm qty-btn">-</a>

        <span class="fw-bold mx-1"><?php echo $item['quantity']; ?></span>

        <a href="update_cart.php?action=increase&id=<?php echo $id; ?>"
           class="btn btn-outline-secondary btn-sm qty-btn">+</a>

    </div>

</td>
        <td>
            <a href="remove_from_cart.php?id=<?php echo $id; ?>"
                class="btn btn-danger btn-sm">Remove</a>
        </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4 px-3">



        <div class="d-flex flex-column align-items-center">
<h4 style="color:#17548b;">
    Total: EGP <?php echo number_format($total, 2); ?>
</h4>

    <a href="checkout.php" class="btn btn-primary btn-lg mt-2">
        Proceed to Checkout
    </a>
</div>

        </div>

    <?php endif; ?>

</div>
</main>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>