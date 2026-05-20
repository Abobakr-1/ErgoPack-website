<?php
$con = mysqli_connect("localhost", "root", "", "ergopack");
$sql = "SELECT * FROM customer";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
</head>

<body>

<?php include('admin_navbar.php'); ?>

<div class="container mt-5">
<div class="report-box">

<h2 class="text-center mb-4">Customer Report</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
    </thead>

    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['C_ID']; ?></td>
            <td><?php echo $row['Username']; ?></td>
            <td><?php echo $row['F_name']; ?></td>
            <td><?php echo $row['L_name']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</div>

</body>
</html>