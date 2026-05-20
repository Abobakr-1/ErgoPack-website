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
                <td>Customer ID</td><td><input type="text" name="C_id"></td>
            </tr>
            <tr>
                <td>Subtotal Price</td><td><input type="text" name="O_subtotal_price"></td>
            </tr>
            <tr>
                <td>Total Price</td><td><input type="text" name="O_totalprice"></td>
            </tr>
            <tr>
                <td>Status</td><td><input type="text" name="O_status"></td>
            </tr>
            <tr>
                <td>Delivery Address</td><td><input type="text" name="Delivery_address"></td>
            </tr>
            <tr>
                <td>Delivery Fee</td><td><input type="text" name="Delivery_fee"></td>
            </tr>
            <tr>
                <td>Delivery Time</td><td><input type="text" name="Delivery_time"></td>
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
    $C_id = $_POST['C_id'];
    $O_subtotal_price = $_POST['O_subtotal_price'];
    $O_totalprice = $_POST['O_totalprice'];
    $O_status = $_POST['O_status'];
    $Delivery_address = $_POST['Delivery_address'];
    $Delivery_fee = $_POST['Delivery_fee'];
    $Delivery_time = $_POST['Delivery_time'];
 
    $con = mysqli_connect("localhost" , "root" , "" , "ergopack");
 
    if($con){
        echo "successful";
 
        $stat = "INSERT INTO orders (O_ID, C_id, O_subtotal_price, O_totalprice , O_status , Delivery_address , Delivery_fee , Delivery_time)
                 VALUES ('$O_ID', '$C_id', '$O_subtotal_price', '$O_totalprice' , '$O_status' , '$Delivery_address' , '$Delivery_fee' , '$Delivery_time')";
 
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