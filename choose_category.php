<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Category</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
</head>
<body>

<?php include('admin_navbar.php'); ?>

<div class="container text-center mt-5">

    <h2 class="text-center mb-3">Add Product</h2>
    <p>Select category to add product</p>

<div class="d-flex justify-content-center gap-4 mt-5 flex-wrap">

<a href="product_adults.php"
   class="btn btn-lg py-3"
   style="background-color:#5d7897;
          border:none;
          color:white;
          width:200px;">
    Adults
</a>

<a href="product_kids.php"
   class="btn btn-lg py-3"
   style="background-color:#5d7897;
          border:none;
          color:white;
          width:200px;">
    Kids
</a>

<a href="product_accessories.php"
   class="btn btn-lg py-3"
   style="background-color:#5d7897;
          border:none;
          color:white;
          width:200px;">
    Accessories
</a>

</div>

    </div>

</div>

</body>
</html>