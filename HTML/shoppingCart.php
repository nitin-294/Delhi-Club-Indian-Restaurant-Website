<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart - Delhi Club Indian Restaurant</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/cart.css">
</head>
<body>

<header>
    <?php include '../PHP/header.php'; ?>
</header>

<main>
    <div class="mainContent">
        <h2>Your Shopping Cart</h2>

        <?php if (count($cart) > 0): ?>
            <table class="cartTable">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php
                $total = 0;
                foreach ($cart as $item):
                    $name = htmlspecialchars($item['item_name']);
                    $price = (float)$item['price'];
                    $qty = (int)$item['quantity'];
                    $subtotal = $price * $qty;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= $name ?></td>
                        <td>$<?= number_format($price, 2) ?></td>
                        <td><?= $qty ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="totalRow">
                    <td colspan="3">Total</td>
                    <td>$<?= number_format($total, 2) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p class="cartEmpty">Your cart is empty.</p>
        <?php endif; ?>
    </div>
</main>

<footer>
    <script src="../JavaScript/footer.js"></script>
</footer>

</body>
</html>
