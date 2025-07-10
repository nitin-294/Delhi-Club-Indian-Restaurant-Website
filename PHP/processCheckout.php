<?php
include 'dbConnection.php';

function redirectWithMessage($url, $msg) {
    $_SESSION['flash_message'] = $msg;
    header("Location: $url");
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$promo = $_SESSION['promo'] ?? null;

if (empty($cart)) {
    redirectWithMessage('shoppingCart.php', 'Your cart is empty. Please add items before checking out.');
}

$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$discount = $promo['discount'] ?? 0;
$finalTotal = $promo['final'] ?? $subtotal;

$errors = [];
$success = false;

$userName = '';
$userEmail = '';
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE id = ?");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $userName = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
        $userEmail = htmlspecialchars($user['email']);
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $payment = trim($_POST['payment'] ?? '');
    $delivery_method = trim($_POST['delivery_method'] ?? '');

    if ($name === '') $errors[] = "Name is required.";
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";

    if (!in_array($delivery_method, ['delivery', 'pickup'])) {
        $errors[] = "Please select a delivery method.";
    } elseif ($delivery_method === 'delivery' && $address === '') {
        $errors[] = "Delivery address is required for delivery option.";
    }

    if (!in_array($payment, ['card', 'paypal', 'cash'])) $errors[] = "Please select a valid payment method.";

    if (empty($errors)) {

        unset($_SESSION['cart']);
        unset($_SESSION['promo']);
        $success = true;
    }
}
