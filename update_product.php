<?php

$con = mysqli_connect("localhost", "root", "", "ergopack");

// Load all products for dropdown
$all_products = mysqli_query($con, "SELECT Pro_id, Pro_name FROM product ORDER BY Pro_name ASC");

$row = null;
$error = "";

/* ───────── LOAD PRODUCT ──────── */
if (isset($_POST['load'])) {

    $id = (int)$_POST['id'];

    $stat = "SELECT * FROM product WHERE Pro_id=$id";
    $res = mysqli_query($con, $stat);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
    } else {
        $error = "Product not found";
    }
}

/* ───────── UPDATE PRODUCT ───────── */
if (isset($_POST['update'])) {

    $id = (int)$_POST['id'];

    $Pro_name = $_POST['Pro_name'];
    $Pro_description = $_POST['Pro_description'];
    $Pro_price = $_POST['Pro_price'];
    $Pro_stock = $_POST['Pro_stock'];

    $target = $_POST['old_image'];

    if (!empty($_FILES['Pro_image']['name'])) {
        $target = "./bags/" . basename($_FILES['Pro_image']['name']);
        move_uploaded_file($_FILES['Pro_image']['tmp_name'], $target);
    }

    $stat = "UPDATE product SET 
        Pro_name='$Pro_name',
        Pro_description='$Pro_description',
        Pro_price='$Pro_price',
        Pro_stock='$Pro_stock',
        Pro_image='$target'
        WHERE Pro_id=$id";

    mysqli_query($con, $stat);

    header("Location: update_product.php");
    exit();
}

/* ───────── DELETE PRODUCT ───────── */
if (isset($_POST['delete'])) {

    $id = (int)$_POST['id'];

    $getImg = mysqli_query($con, "SELECT Pro_image FROM product WHERE Pro_id=$id");

    if ($getImg && mysqli_num_rows($getImg) > 0) {
        $imgRow = mysqli_fetch_assoc($getImg);

        if (file_exists($imgRow['Pro_image'])) {
            unlink($imgRow['Pro_image']);
        }
    }

    mysqli_query($con, "DELETE FROM product WHERE Pro_id=$id");

    header("Location: update_product.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css.css">
</head>

<body>

<?php include('admin_navbar.php'); ?>

    <div class="login-box">
        <h2 class="text-center mb-3" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Update Products</h2>

    <?php if ($error != "") echo "<div style='color:red;'>$error</div>"; ?>

<!-- LOAD PRODUCT -->
<form method="post">
    <div class="d-flex gap-2 align-items-center">

        <select name="id" required>
            <option value="" disabled selected>-- Select a Product --</option>
            <?php while($p = mysqli_fetch_assoc($all_products)) { ?>
                <option value="<?php echo $p['Pro_id']; ?>">
                    <?php echo $p['Pro_name']; ?>
                </option>
            <?php } ?>
        </select>

        <input type="submit" name="load" value="Load Product" class="btn-login">

    </div>
</form>

<hr>

<!-- UPDATE FORM -->
<?php if ($row != null) { ?>

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $row['Pro_id']; ?>">
    <input type="hidden" name="old_image" value="<?php echo $row['Pro_image']; ?>">

    <input type="text" name="Pro_name"
        value="<?php echo $row['Pro_name']; ?>"
        placeholder="Product Name">

    <input type="text" name="Pro_description"
        value="<?php echo $row['Pro_description']; ?>"
        placeholder="Description">

    <input type="text" name="Pro_price"
        value="<?php echo $row['Pro_price']; ?>"
        placeholder="Price">

    <input type="number" name="Pro_stock"
        value="<?php echo $row['Pro_stock']; ?>"
        placeholder="Stock">

    <input type="file" name="Pro_image" accept="image/*">

    <input type="submit" name="update" value="Update Product" class="btn-login">

    <button type="submit" name="delete"
        onclick="return confirm('Are you sure you want to delete this product?')"
        class="btn-login"
        style="background:#dc3545; width:305px; border-radius:5px; height:40px;">
        Delete Product
    </button>

</form>

<?php } ?>

</div>

</body>
</html>