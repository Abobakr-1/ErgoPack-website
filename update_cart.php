<?php
session_start();

if (!isset($_GET['id'], $_GET['action'])) {
    header("Location: mycart.php");
    exit;
}

$id = (int) $_GET['id'];
$action = $_GET['action'];

if (!isset($_SESSION['cart'][$id])) {
    header("Location: mycart.php");
    exit;
}

// increase
if ($action === "increase") {
    $_SESSION['cart'][$id]['quantity']++;
}

// decrease
if ($action === "decrease") {
    $_SESSION['cart'][$id]['quantity']--;

    // remove if 0
    if ($_SESSION['cart'][$id]['quantity'] <= 0) {
        unset($_SESSION['cart'][$id]);
    }
}

header("Location: mycart.php");
exit;
?>