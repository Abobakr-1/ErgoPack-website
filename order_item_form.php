<html lang="en">
<head>
</head>
<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>Order ID</td><td><input type="text" name="O_ID"></td>
            </tr>
            <tr>
                <td>Product ID</td><td><input type="text" name="P_ID"></td>
            </tr>
            <tr>
                <td>Quantity</td><td><input type="number" name="O_quantity"></td>
            </tr>
            <tr>
                <td>Price</td><td><input type="text" name="O_price"></td>
            </tr>
            <tr>
                <td>Total Price</td><td><input type="text" name="O_total_price"></td>
            </tr>
            <tr>
                <td><input type="submit" name="btn"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php

if(isset($_POST['btn'])){

    $O_ID = $_POST['O_ID'];
    $P_ID = $_POST['P_ID'];
    $O_quantity = $_POST['O_quantity'];
    $O_price = $_POST['O_price'];
    $O_total_price = $_POST['O_total_price'];

    $con = mysqli_connect("localhost" , "root" , "" , "ergopack");

    if($con){
        echo "successful";

        $stat = "INSERT INTO order_items (O_ID, P_ID, O_quantity, O_price , O_total_price)
                 VALUES ('$O_ID', '$P_ID', '$O_quantity', '$O_price' , '$O_total_price')";

        $res = mysqli_query($con , $stat);

        if(!$res)
            echo " error: " . mysqli_error($con);
        else
            echo " $O_ID successfully";

    } else {
        echo "connection error";
    }

}
?>