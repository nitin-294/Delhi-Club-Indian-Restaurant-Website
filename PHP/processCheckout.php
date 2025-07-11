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

$subtotal = array_reduce($cart, fn($s, $item) => $s + $item['price'] * $item['quantity'], 0);

$discount   = $promo['discount'] ?? 0;
$finalTotal = $promo['final']    ?? $subtotal;

$errors  = [];
$success = false;

$userName  = '';
$userEmail = '';
if (!empty($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE id = ?");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    if ($u = $stmt->get_result()->fetch_assoc()) {
        $userName  = htmlspecialchars("{$u['first_name']} {$u['last_name']}");
        $userEmail = htmlspecialchars($u['email']);
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $address = trim($_POST['address'] ?? '');

    $payment         = strtolower(trim($_POST['payment']         ?? ''));
    $delivery_method = trim($_POST['delivery_method'] ?? '');

    if ($name === '') {
        $errors['name'] = 'Name is required.';
    }
    if ($email === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Valid email is required.';
    }

    if (!in_array($delivery_method, ['delivery', 'pickup'], true)) {
        $errors['delivery_method'] = 'Please select a delivery method.';
    } elseif ($delivery_method === 'delivery' && $address === '') {
        $errors['address'] = 'Delivery address is required for delivery option.';
    }

    if (!in_array($payment, ['card', 'paypal', 'cash'], true)) {
        $errors['payment'] = 'Please select a valid payment method.';
    }

    if ($payment === 'card') {
        $card_number = preg_replace('/\s+/', '', $_POST['card_number'] ?? '');
        $expiry_date = $_POST['expiry_date'] ?? '';
        $cvv         = $_POST['cvv'] ?? '';

        if (!preg_match('/^\d{13,19}$/', $card_number)) {
            $errors['card_number'] = 'Please enter a valid card number (13–19 digits).';
        }
        if (!preg_match('/^(0[1-9]|1[0-2])\/?(\d{2}|\d{4})$/', $expiry_date)) {
            $errors['expiry_date'] = 'Please enter a valid expiry date (MM/YY).';
        }
        if (!preg_match('/^\d{3,4}$/', $cvv)) {
            $errors['cvv'] = 'Please enter a valid CVV (3 or 4 digits).';
        }
    }

    if (!$errors) {
        $stmt = $conn->prepare("INSERT INTO orders (name, email, delivery_method, address, payment_method, subtotal, discount, final_total, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param(
            "sssssddd",
            $name,
            $email,
            $delivery_method,
            $address,
            $payment,
            $subtotal,
            $discount,
            $finalTotal
        );

        if ($stmt->execute()) {
            $order_id = $stmt->insert_id;

            $stmtItems = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
            foreach ($cart as $item) {
                $stmtItems->bind_param(
                    "isid",
                    $order_id,
                    $item['item_name'],
                    $item['quantity'],
                    $item['price']
                );
                $stmtItems->execute();
            }
            $stmtItems->close();

            unset($_SESSION['cart'], $_SESSION['promo']);

            $_SESSION['last_order_id'] = $order_id;

            $success = true;
        } else {
            $errors['db'] = 'Error processing your order. Please try again.';
        }
        $stmt->close();
    }
}

if (
    isset($_SERVER['HTTP_ACCEPT'])
    && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json')
) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'errors'  => $errors,
    ]);
    exit;
}
?>
