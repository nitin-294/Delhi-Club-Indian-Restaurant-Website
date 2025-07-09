<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_name'], $_POST['action'])) {
    $itemName = $_POST['item_name'];
    $action = $_POST['action'];

    if (!isset($_SESSION['cart'][$itemName])) {
        echo json_encode(['status' => 'error', 'message' => 'Item not found in cart']);
        exit;
    }

    switch ($action) {
        case 'increase':
            $_SESSION['cart'][$itemName]['quantity'] += 1;
            break;

        case 'decrease':
            if ($_SESSION['cart'][$itemName]['quantity'] > 1) {
                $_SESSION['cart'][$itemName]['quantity'] -= 1;
            }
            break;

        case 'remove':
            unset($_SESSION['cart'][$itemName]);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            exit;
    }

    $totalQty = 0;
    $totalPrice = 0;

    foreach ($_SESSION['cart'] as $item) {
        $totalQty += $item['quantity'];
        $totalPrice += $item['quantity'] * $item['price'];
    }

    $_SESSION['cart_count'] = $totalQty;

    echo json_encode([
        'status' => 'success',
        'count' => $totalQty,
        'total' => number_format($totalPrice, 2),
        'cart' => $_SESSION['cart']
    ]);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit;
}
