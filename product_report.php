<?php
$con = mysqli_connect("localhost", "root", "", "ergopack");
$sql = "SELECT * FROM product";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
</head>

<body>

<?php include('admin_navbar.php'); ?>

<div class="container mt-5">
<div class="report-box">

<h2 class="text-center mb-4">Products Report</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Type</th>
            <th>Image</th>
        </tr>
    </thead>

    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['Pro_id']; ?></td>
            <td><?php echo $row['Pro_name']; ?></td>
            <td><?php echo $row['Pro_description']; ?></td>
            <td><?php echo $row['Pro_price']; ?></td>
            <td><?php echo $row['Pro_stock']; ?></td>
            <td><?php echo $row['Pro_type']; ?></td>
            <td><img src="<?php echo $row['Pro_image']; ?>" width="80"></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</div>

</body>
</html>