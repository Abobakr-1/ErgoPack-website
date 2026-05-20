<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "ergopack");

if (!isset($_GET['id'])) {
    die("Product ID missing");
}

$id = (int) $_GET['id'];

$stmt = $con->prepare("SELECT * FROM product WHERE Pro_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if (!$row) {
    die("Product not found");
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantity']++;
} else {
    $_SESSION['cart'][$id] = [
        'Pro_id'   => $row['Pro_id'],
        'Pro_name' => $row['Pro_name'],
        'Pro_description' => $row['Pro_description'],
        'Pro_price' => $row['Pro_price'],
        'Pro_image' => $row['Pro_image'],
        'Pro_type' => $row['Pro_type'],
        "Pro_stock" => $row['Pro_stock'],
        'quantity' => 1
    ];
}

$_SESSION['cartItemCount'] = count($_SESSION['cart']);

header("Location: " . ($_SERVER['HTTP_REFERER'] ?? "home_page.php"));
exit;
?>