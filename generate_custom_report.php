<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Custom Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
</head>
<body>

<?php include('admin_navbar.php'); ?>

<div class="container mt-5">
<div class="report-box">
<h2 class="text-center mb-4">Generated Report</h2>

<?php
$con = mysqli_connect("localhost", "root", "", "ergopack");

$fields = $_POST['fields'] ?? [];

if(empty($fields)){
    die("<div class='alert alert-warning'>No fields selected. <a href='custom_report.php'>Go back</a></div>");
}

$orderFields = ['O_ID','O_subtotal_price','O_totalprice','O_status','Delivery_address','Delivery_fee','Delivery_time','pay_method'];
$customerFields  = ['C_ID','Username','F_name','L_name','C_email','C_phone','C_address','C_gender'];
$productFields   = ['Pro_name','Pro_price','Pro_stock','Pro_type','Pro_description'];
$orderItemFields = ['O_quantity','O_price','O_total_price'];

$selectedOrder     = array_intersect($fields, $orderFields);
$selectedCustomer  = array_intersect($fields, $customerFields);
$selectedProduct   = array_intersect($fields, $productFields);
$selectedOrderItem = array_intersect($fields, $orderItemFields);

$cols = [];
foreach($selectedOrder as $col){
    $cols[] = "orders.$col";
}
foreach($selectedCustomer as $col){
    $cols[] = "customer.$col";
}
foreach($selectedOrderItem as $col){
    $cols[] = "order_items.$col";
}
foreach($selectedProduct as $col){
    $cols[] = "product.$col";
}

if(!empty($selectedOrder) && !empty($selectedCustomer) && !empty($selectedProduct)){
    $sql = "SELECT " . implode(", ", $cols) . "
            FROM orders
            LEFT JOIN customer ON orders.C_id = customer.C_ID
            LEFT JOIN order_items ON orders.O_ID = order_items.O_ID
            LEFT JOIN product ON order_items.P_ID = product.Pro_id";

} else if(!empty($selectedOrder) && !empty($selectedCustomer)){
    $sql = "SELECT " . implode(", ", $cols) . "
            FROM orders
            LEFT JOIN customer ON orders.C_id = customer.C_ID";

} else if(!empty($selectedOrder) && !empty($selectedProduct)){
    $sql = "SELECT " . implode(", ", $cols) . "
            FROM orders
            LEFT JOIN order_items ON orders.O_ID = order_items.O_ID
            LEFT JOIN product ON order_items.P_ID = product.Pro_id";

} else if(!empty($selectedOrder)){
    $sql = "SELECT " . implode(", ", $cols) . " FROM orders";

} else if(!empty($selectedCustomer)){
    $cols = array_map(fn($c) => "customer.$c", $selectedCustomer);
    $sql = "SELECT " . implode(", ", $cols) . " FROM customer";

} else if(!empty($selectedProduct)){
    $cols = array_map(fn($c) => "product.$c", $selectedProduct);
    $sql = "SELECT " . implode(", ", $cols) . " FROM product";

} else {
    die("<div class='alert alert-warning'>Please go back and select valid fields. <a href='custom_report.php'>Go back</a></div>");
}

$result = mysqli_query($con, $sql);

if(!$result){
    die("<div class='alert alert-danger'>Query error: " . mysqli_error($con) . "</div>");
}

$displayFields = array_merge(
    array_values($selectedOrder),
    array_values($selectedCustomer),
    array_values($selectedOrderItem),
    array_values($selectedProduct)
);
?>

<table class="table">
    <thead>
        <tr>
            <?php foreach($displayFields as $col): ?>
                <th><?php echo $col; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>

    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <?php foreach($displayFields as $col): ?>
                <td><?php echo $row[$col] ?? '-'; ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="text-center mt-3">
    <a href="custom_report.php" class="btn btn-primary" style="margin-bottom: 30px;">Generate Another Report</a>
</div>

</div>
</div>
</body>
</html>