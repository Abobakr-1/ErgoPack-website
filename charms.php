<?php
$con = mysqli_connect("localhost", "root", "", "ergopack");

$stat = "SELECT * FROM product WHERE Pro_type='Accessories'";
$res = mysqli_query($con, $stat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessories</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css.css">
</head>


<body>

<?php include('navbar.php'); ?>
<?php if(empty($search_query)): ?>

<main class="flex-grow-1">

<div class="container mt-4">

    <h2 class="mb-4 text-center">Accessories</h2>

    <div class="row g-4">

        <?php while($row = mysqli_fetch_assoc($res)) { ?>

        <div class="col-md-4">

            <div class="card h-100 shadow-sm">

                <img src="<?php echo $row['Pro_image']; ?>" 
                     class="card-img-top"
                     style="height:300px; object-fit:cover;">

                <div class="card-body d-flex flex-column">

                    <h5 class="card-title">
                        <?php echo $row['Pro_name']; ?>
                    </h5>

                    <p class="card-text">
                        <?php echo $row['Pro_description']; ?>
                    </p>

                    <h6 class="mb-3">
                        <?php echo " EGP" . $row['Pro_price']; ?>
                    </h6>

                    <a href="add_to_cart.php?id=<?php echo $row['Pro_id']; ?>" class="btn btn-primary mt-auto">
                        Add to Cart
                    </a>
                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>
</main>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<?php include('footer.php'); ?>

</body>
</html>