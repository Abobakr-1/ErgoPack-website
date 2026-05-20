<?php
session_start();

$id = $_GET['id'];

if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
}

$_SESSION['cartItemCount'] = count($_SESSION['cart']);

header('Location: mycart.php');
exit;
?>