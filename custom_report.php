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
        <h2 class="text-center mb-4">Create Report</h2>

        <form action="generate_custom_report.php" method="POST">

            <!-- ORDER DATA -->
            <h4>Order Data</h4>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="O_ID">
                <label class="form-check-label">Order ID</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="O_subtotal_price">
                <label class="form-check-label">Subtotal Price</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="O_totalprice">
                <label class="form-check-label">Total Price</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="O_status">
                <label class="form-check-label">Order Status</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="Delivery_address">
                <label class="form-check-label">Delivery Address</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="Delivery_fee">
                <label class="form-check-label">Delivery Fee</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="Delivery_time">
                <label class="form-check-label">Delivery Time</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="pay_method">
                <label class="form-check-label">Payment Method</label>
            </div>
            <hr>

            <!-- CUSTOMER DATA -->
            <h4>Customer Data</h4>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="C_ID">
                <label class="form-check-label">Customer ID</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="Username">
                <label class="form-check-label">Username</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="F_name">
                <label class="form-check-label">First Name</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="L_name">
                <label class="form-check-label">Last Name</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="C_email">
                <label class="form-check-label">Email</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="C_phone">
                <label class="form-check-label">Phone</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="C_address">
                <label class="form-check-label">Customer Address</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="C_gender">
                <label class="form-check-label">Gender</label>
            </div>

            <hr>

            <!-- PRODUCT DATA -->
            <h4>Product Data</h4>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="Pro_name">
                <label class="form-check-label">Product Name</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="Pro_price">
                <label class="form-check-label">Price</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="Pro_stock">
                <label class="form-check-label">Stock</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="Pro_type">
                <label class="form-check-label">Product Type</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fields[]" value="Pro_description">
                <label class="form-check-label">Product Description</label>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg" style="margin-bottom: 20px;">
                    Generate Report
                </button>
            </div>

        </form>

    </div>
</div>

</body>
</html>