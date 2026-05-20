<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Reports</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
</head>
<body>

<?php include('admin_navbar.php'); ?>

<div class="container text-center mt-5">
<h2 class="text-center mb-3">Reports</h2>
   <p>Select which report you want to view</p>

<div class="d-flex justify-content-center gap-4 mt-5 flex-wrap">

<a href="customer_report.php"
   class="btn btn-lg px-5 py-3"
   style="background-color:#5d7897; border:none; color:white;">
    Customer Report
</a>

<a href="product_report.php"
   class="btn btn-lg px-5 py-3"
   style="background-color:#5d7897; border:none; color:white;">
    Product Report
</a>

<a href="custom_report.php"
   class="btn btn-lg px-5 py-3"
   style="background-color:#5d7897; border:none; color:white;">
    Custom Report
</a>

</div>

</div>

</body>
</html>