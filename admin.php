<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css.css">

    <style>

        body{
            background-color: #f5f7fa;
        }
        

        .admin-home{
            padding: 60px;
            text-align: center;
        }

        .logo-section img{
            width: 280px;
            margin-bottom: 30px;
        }
        .logo-section{
    background: white;
    width: 70%;
    margin: auto;
    padding: 50px;
    border-radius: 25px;

    box-shadow: 0px 5px 15px rgba(0,0,0,0.06);
}

        .logo-section h1{
            color: #6f8fb3;
            font-size: 45px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .logo-section p{
            color: gray;
            font-size: 18px;
            margin-bottom: 35px;
        }

        .buttons{
    display: flex;
    justify-content: center;
    gap: 15px;
}

.btn1,
.btn2,
.btn3{
    background-color: #6f8fb3;
    color: white;

    padding: 12px 25px;
    text-decoration: none;
    border-radius: 10px;

    transition: 0.3s;
}

.btn1:hover,
.btn2:hover,
.btn3:hover{
    background-color: #5d7897;
}

.btn1:hover,
.btn2:hover,
.btn3:hover{
    background-color:#5d7897;
    transform: translateY(-3px);
}

    </style>

</head>

<?php include('admin_navbar.php'); ?>



<body>
  

    <div class="admin-home">

        <div class="logo-section">

            <img src="bags/others/logo2.jpeg" alt="Logo">

            <h1>Welcome Back, Admin</h1>
  
            <p>
                Manage products, update inventory, and monitor ErgoPack easily.
            </p>

            <div class="buttons">

<a href="choose_category.php"
   class="btn1"
   style="width:200px; display:inline-block; text-align:center;">
   Add Product
</a>

<a href="update_product.php"
   class="btn2"
   style="width:200px; display:inline-block; text-align:center;">
   Update Product
</a>

<a href="admin_report.php"
   class="btn3"
   style="width:200px; display:inline-block; text-align:center;">
   View Reports
</a>
</div>

        </div>

    </div>

</body>
</html>