<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Delhi Club Indian Restaurant - Shopping Cart</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/cart.css">
</head>
<body>

<header>
    <?php include '../PHP/header.php'; ?>
</header>

<main>
    <div class="mainContent">

        <?php if (count($cart) > 0): ?>
            <table class="cartTable">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
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
                    <td><strong><?= $name ?></strong></td>
                    <td>$<?= number_format($price, 2) ?></td>
                    <td>
                        <form action="../PHP/cartAction.php" method="POST" class="quantityForm" style="display:inline;">
                            <input type="hidden" name="item_name" value="<?= $name ?>">
                            <button type="submit" name="action" value="decrease"><strong>-</strong></button>
                            <input type="text" name="quantity" value="<?= $qty ?>" size="2" readonly>
                            <button type="submit" name="action" value="increase"><strong>+</strong></button>
                        </form>
                    </td>
                    <td><strong>$<?= number_format($subtotal, 2) ?></strong></td>
                    <td>
                        <form action="../PHP/cartAction.php" method="POST" style="display:inline;">
                            <input type="hidden" name="item_name" value="<?= $name ?>">
                            <button type="submit" name="action" value="remove" class="removeBtn">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr class="totalRow">
                    <td colspan="3"><strong>Total</strong></td>
                    <td colspan="2"><strong>$<?= number_format($total, 2) ?></strong></td>
                </tr>
            </table>

            <div class="cartActions">
                <a href="checkout.php" class="checkoutBtn">Proceed to Checkout</a>
            </div>

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
