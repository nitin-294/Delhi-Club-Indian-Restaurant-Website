<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['promo'])) {
    $promo = $_SESSION['promo'];

    if (isset($promo['free_item'])) {
        $freeItem = $promo['free_item'];
        if (isset($_SESSION['cart'][$freeItem])) {
            unset($_SESSION['cart'][$freeItem]);
        }
    }

    unset($_SESSION['promo']);
}

$cart = $_SESSION['cart'] ?? [];
$subtotal = 0;
$count = 0;

foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
    $count += $item['quantity'];
}

echo json_encode([
    'status' => 'success',
    'message' => 'Promo code removed.',
    'subtotal' => round($subtotal, 2),
    'discount' => 0,
    'finalTotal' => round($subtotal, 2),
    'count' => $count,
    'cart' => $cart,
    'promoFreeItemName' => null
]); 
exit;

