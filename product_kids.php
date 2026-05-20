<?php

if(isset($_POST['btn'])){

    $Pro_name = $_POST['Pro_name'];
    $Pro_description = $_POST['Pro_description'];
    $Pro_price = $_POST['Pro_price'];
    $Pro_stock = $_POST['Pro_stock'];

    $Pro_type = "Kids";

    $con = mysqli_connect("localhost", "root", "", "ergopack");

    if(!$con){
        $error = "Connection error";
    } else {

        $target = "./bags/" . basename($_FILES['Pro_image']['name']);
        move_uploaded_file($_FILES['Pro_image']['tmp_name'], $target);

        $stat = "INSERT INTO product 
        (Pro_name, Pro_description, Pro_price, Pro_stock, Pro_type, Pro_image)
        VALUES 
        ('$Pro_name', '$Pro_description', '$Pro_price', '$Pro_stock', '$Pro_type', '$target')";

        $res = mysqli_query($con, $stat);

if($res){
            header("Location: Product_kids.php");
    exit();
} else {
    $error = mysqli_error($con);
}    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Kids Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css.css">
</head></head>
<body>

<?php include('admin_navbar.php'); ?>

<div class="login-box">
<h1>Add Kids Product</h1>

<?php if(isset($error)) echo "<div>$error</div>"; ?>

<form method="post" enctype="multipart/form-data">

    <input type="text" name="Pro_name" placeholder="Product Name" required>
    <input type="text" name="Pro_description" placeholder="Description" required>
    <input type="text" name="Pro_price" placeholder="Price" required>
    <input type="number" name="Pro_stock" placeholder="Stock" required>
    <input type="file" name="Pro_image" required>

    <input type="submit" name="btn" value="Add Product">

</form>
</div>

</body>
</html>