<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit;
}

include '../PHP/dbConnection.php';

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT first_name, last_name, email, username, password FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$orders = [];
if ($user && !empty($user['email'])) {
    $stmtOrders = $conn->prepare("SELECT * FROM orders WHERE email = ? ORDER BY created_at DESC");
    $stmtOrders->bind_param('s', $user['email']);
    $stmtOrders->execute();
    $orders = $stmtOrders->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmtOrders->close();
}

$updateMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';

    $checkStmt = $conn->prepare("SELECT id FROM users WHERE (email = ? OR username = ?) AND id != ?");
    $checkStmt->bind_param("ssi", $email, $username, $userId);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $updateMessage = "Email or username is already taken.";
    } else {
        if (!empty($currentPassword) && !empty($newPassword)) {
            if (!password_verify($currentPassword, $user['password'])) {
                $updateMessage = "Incorrect current password.";
            } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/', $newPassword)) {
                $updateMessage = "New password must be at least 8 characters long and contain at least 1 uppercase letter, 1 number, and 1 special character.";
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ?, password = ? WHERE id = ?");
                $stmt->bind_param("sssssi", $firstName, $lastName, $email, $username, $hashedPassword, $userId);
            }
        } else {
            $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $firstName, $lastName, $email, $username, $userId);
        }

        if (empty($updateMessage)) {
            if ($stmt->execute()) {
                $updateMessage = "Profile updated successfully!";

                $user['first_name'] = $firstName;
                $user['last_name'] = $lastName;
                $user['email'] = $email;
                $user['username'] = $username;
            } else {
                $updateMessage = "Update failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delhi Club Indian Restaurant - Profile</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/profile.css">
</head>
<body>
<header>
    <?php include '../PHP/header.php'; ?>
</header>

<main>
    <div class="mainContent signin-container">

        <h2>Your Past Orders</h2>
        <?php if (empty($orders)): ?>
            <p>You have no past orders.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="orderCard" style="border:1px solid #ccc; padding:1rem; margin-bottom:1rem;">
                    <strong>Order #<?= $order['id'] ?></strong> - <?= date('d M Y, h:i A', strtotime($order['created_at'])) ?><br>
                    Delivery: <?= htmlspecialchars($order['delivery_method']) ?> | Payment: <?= htmlspecialchars($order['payment_method']) ?><br>
                    Subtotal: $<?= number_format($order['subtotal'], 2) ?> | Discount: $<?= number_format($order['discount'], 2) ?> | Total: $<?= number_format($order['final_total'], 2) ?><br>
                    Address: <?= htmlspecialchars($order['address'] ?? 'N/A') ?>
                    <br><br>
                    <details>
                        <summary>View Items</summary>
                        <table style="width:100%; border-collapse: collapse;" border="1">
                            <thead>
                                <tr>
                                    <th>Item</th><th>Quantity</th><th>Price</th><th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmtItems = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
                                $stmtItems->bind_param('i', $order['id']);
                                $stmtItems->execute();
                                $items = $stmtItems->get_result()->fetch_all(MYSQLI_ASSOC);
                                $stmtItems->close();

                                foreach ($items as $item):
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['item_name']) ?></td>
                                        <td><?= (int)$item['quantity'] ?></td>
                                        <td>$<?= number_format($item['price'], 2) ?></td>
                                        <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </details>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>


        <h2>Profile Details:</h2>
        <form action="profile.php" method="post">
            <label>First Name:</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label>Username:</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

            <?php if ($updateMessage && strpos($updateMessage, 'Email or username') !== false): ?>
                <div style="color: red; margin-top: 1rem;">
                    <?= htmlspecialchars($updateMessage) ?>
                </div>
            <?php endif; ?>

            <hr style="margin: 2rem 0 1rem;">

            <label>Current Password:</label>
            <input type="password" name="current_password" placeholder="Enter current password">

            <label>New Password:</label>
            <input type="password" name="new_password" placeholder="Leave blank to keep current password">

            <?php if ($updateMessage && strpos($updateMessage, 'Email or username') === false): ?>
                <div style="color: <?= str_contains($updateMessage, 'successfully') ? 'green' : 'red' ?>; margin-top: 1rem;">
                    <?= htmlspecialchars($updateMessage) ?>
                </div>
            <?php endif; ?>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</main>

<footer>
    <script src="../JavaScript/footer.js"></script>
</footer>
</body>
</html>
