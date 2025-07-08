<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item_name'] ?? '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($item === '' || $price <= 0 || $quantity < 1) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        exit;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $key = $item;

    if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$key] = [
            'item_name' => $item,     
            'price' => $price,
            'quantity' => $quantity
        ];
    }

    $totalCount = 0;
    foreach ($_SESSION['cart'] as $cartItem) {
        $totalCount += $cartItem['quantity'];
    }

    $_SESSION['cart_count'] = $totalCount;

    echo json_encode(['status' => 'success', 'count' => $totalCount]);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}
