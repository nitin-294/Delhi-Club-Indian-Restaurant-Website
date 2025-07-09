<?php
session_start();
include 'dbConnection.php';
header('Content-Type: application/json');

$code = strtoupper(trim($_POST['promoCode'] ?? ''));
if ($code === '') {
    echo json_encode(['status' => 'error', 'message' => 'Promo code is required.']);
    exit;
}

$sql = "SELECT * FROM promocodes WHERE code = ? AND (expires_at IS NULL OR expires_at > NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $code);
$stmt->execute();
$result = $stmt->get_result();
$promo = $result->fetch_assoc();

if (!$promo) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid promo code.']);
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['quantity'] * $item['price'];
}

$discount = 0;
$finalTotal = $total;
$freeItemName = null;

if ($promo['promo_type'] === 'discount') {
    if ($promo['discount_type'] === 'percent') {
        $discount = $total * ($promo['discount_value'] / 100);
    } elseif ($promo['discount_type'] === 'fixed') {
        $discount = $promo['discount_value'];
    }
    $discount = min($discount, $total);
    $finalTotal = $total - $discount;

    $_SESSION['promo'] = [
        'code' => $promo['code'],
        'discount' => $discount,
        'final' => $finalTotal
    ];
} elseif ($promo['promo_type'] === 'free_item') {
    $freeItemName = $promo['free_item'];
    $found = false;

    foreach ($_SESSION['cart'] as $key => &$item) {
        if ($item['item_name'] === $freeItemName) {
            $item['quantity'] += 1;
            $item['price'] = 0;
            $found = true;
            break;
        }
    }
    unset($item);

    if (!$found) {
        $_SESSION['cart'][$freeItemName] = [
            'item_name' => $freeItemName,
            'price' => 0,
            'quantity' => 1
        ];
    }

    $_SESSION['promo'] = [
        'code' => $promo['code'],
        'discount' => 0,
        'final' => $total,
        'free_item' => $freeItemName
    ];
}

$totalCount = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalCount += $item['quantity'];
}

echo json_encode([
    'status' => 'success',
    'message' => "Promo code '{$promo['code']}' applied successfully!",
    'subtotal' => round($total, 2),
    'discount' => round($discount, 2),
    'finalTotal' => round($finalTotal, 2),
    'count' => $totalCount,
    'cart' => $_SESSION['cart'],
    'promoFreeItemName' => $freeItemName
]);
exit;
