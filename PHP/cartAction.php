<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_name'], $_POST['action'])) {
    $itemName = $_POST['item_name'];
    $action = $_POST['action'];

    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['item_name'] === $itemName) {
            if ($action === 'increase') {
                $_SESSION['cart'][$index]['quantity']++;
            } elseif ($action === 'decrease') {
                if ($_SESSION['cart'][$index]['quantity'] > 1) {
                    $_SESSION['cart'][$index]['quantity']--;
                }
            } elseif ($action === 'remove') {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
            break;
        }
    }
}

header('Location: ../HTML/shoppingCart.php');
exit;
