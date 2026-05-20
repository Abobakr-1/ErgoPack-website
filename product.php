<?php
$con = mysqli_connect("localhost", "root", "", "ergopack");

$product_sql = "SELECT * FROM product";
$product_result = mysqli_query($con, $product_sql);
?>

<?php include('admin_navbar.php'); ?>

<div class="container mt-4">
    <h1>Product Report</h1>

    <table class="table table-bordered table-striped">
        <!-- <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Type</th>
            <th>Image</th>
        </tr> -->

        <?php while($row = mysqli_fetch_assoc($product_result)){ ?>
        <tr>
            <td><?php echo $row['Pro_id']; ?></td>
            <td><?php echo $row['Pro_name']; ?></td>
            <td><?php echo $row['Pro_price']; ?></td>
            <td><?php echo $row['Pro_stock']; ?></td>
            <td><?php echo $row['Pro_type']; ?></td>
            <td><img src="<?php echo $row['Pro_image']; ?>" width="60"></td>
        </tr>
        <?php } ?>
    </table>
</div>