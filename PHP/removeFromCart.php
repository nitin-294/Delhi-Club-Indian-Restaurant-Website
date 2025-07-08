<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_name'])) {
    $targetName = $_POST['item_name'];

    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['item_name'] === $targetName) {
            unset($_SESSION['cart'][$index]);
            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

header('Location: ../HTML/shoppingCart.php');
exit;
