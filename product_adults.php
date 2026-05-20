<?php

if(isset($_POST['btn'])){

    $Pro_name = $_POST['Pro_name'];
    $Pro_description = $_POST['Pro_description'];
    $Pro_price = $_POST['Pro_price'];
    $Pro_stock = $_POST['Pro_stock'];
    $Pro_type = "Adults";

    $con = mysqli_connect("localhost", "root", "", "ergopack");

    if(!$con){
        $error = "Connection error";
    } else {

        $filename = basename($_FILES['Pro_image']['name']);
        $target = "./bags/" . $filename;
        $db_image_path = "bags/" . $filename;

        move_uploaded_file($_FILES['Pro_image']['tmp_name'], $target);

        $stat = "INSERT INTO product 
        (Pro_name, Pro_description, Pro_price, Pro_stock, Pro_type, Pro_image)
        VALUES 
        ('$Pro_name', '$Pro_description', '$Pro_price', '$Pro_stock', '$Pro_type', '$db_image_path')";

        $res = mysqli_query($con, $stat);

        if($res){
            header("Location: Product_adults.php");
            exit();
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Adults Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css.css">
</head>
<body>

<?php include('admin_navbar.php'); ?>

<div class="login-box">

    <h1>Add Adults Product</h1>

    <?php if(isset($error)) { ?>
        <div style="color:red; margin-bottom:10px;">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="Pro_name" placeholder="Product Name" required>
        <input type="text" name="Pro_description" placeholder="Description" required>
        <input type="text" name="Pro_price" placeholder="Price" required>
        <input type="number" name="Pro_stock" placeholder="Stock" required>
        <input type="file" name="Pro_image" accept="image/*" required>
        <input type="submit" name="btn" value="Add Product" class="btn-login">
    </form>

</div>

</body>
</html>