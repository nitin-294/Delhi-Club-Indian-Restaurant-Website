<?php
session_start();

$totalQuantity = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalQuantity += $item['quantity'];
    }
}

header('Content-Type: application/json');
echo json_encode(['totalQuantity' => $totalQuantity]);
