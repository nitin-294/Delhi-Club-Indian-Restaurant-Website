<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$promo = $_SESSION['promo'] ?? null;

$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$discount = $promo['discount'] ?? 0.0;
$finalTotal = $promo['final'] ?? $subtotal;
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
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($cart as $item): 
                    $name = htmlspecialchars($item['item_name']);
                    $price = (float)$item['price'];
                    $qty = (int)$item['quantity'];
                    $itemSubtotal = $price * $qty;
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
                    <td><strong>$<?= number_format($itemSubtotal, 2) ?></strong></td>
                    <td>
                        <form action="../PHP/cartAction.php" method="POST" style="display:inline;">
                            <input type="hidden" name="item_name" value="<?= $name ?>">
                            <button type="submit" name="action" value="remove" class="removeBtn">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>

                <tr class="totalRow">
                    <td colspan="3"><strong>Subtotal</strong></td>
                    <td colspan="2"><strong>$<?= number_format($subtotal, 2) ?></strong></td>
                </tr>

                <?php if ($promo && $promo['discount'] > 0): ?>
                    <tr class="discountRow">
                        <td colspan="3"><strong>Discount</strong></td>
                        <td colspan="2" id="discountAmount"><strong>-$<?= number_format($promo['discount'], 2) ?></strong></td>
                    </tr>
                    <tr class="finalTotalRow">
                        <td colspan="3"><strong>Final Total</strong></td>
                        <td colspan="2" id="finalTotal"><strong>$<?= number_format($promo['final'], 2) ?></strong></td>
                    </tr>
                <?php endif; ?>
            </table>

            <!-- Promo code form -->
            <form id="promoForm">
                <label for="promoCode">Have a promo code?</label>
                <input type="text" id="promoCode" name="promoCode" autocomplete="off" placeholder="Enter promo code">
                <button type="submit" id="applyPromoBtn">Apply</button>
                <button type="button" id="removePromoBtn">Remove Promo</button>
            </form>

            <p id="promoMessage">
                <?php if ($promo): ?>
                    Promo code <strong><?= htmlspecialchars($promo['code']) ?></strong> applied.
                <?php endif; ?>
            </p>

            <div class="cartActions">
                <a href="checkout.php" class="checkoutBtn">Proceed to Checkout</a>
            </div>

        <?php else: ?>
            <p class="cartEmpty">Your cart is empty.</p>
        <?php endif; ?>

    </div>
</main>

<footer>
    <script src="../JavaScript/cart.js"></script>
    <script src="../JavaScript/footer.js"></script>
</footer>

</body>
</html>
