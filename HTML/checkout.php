<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Delhi Club Indian Restaurant - Checkout</title>
  <link rel="stylesheet" href="../CSS/basicLayout.css" />
  <link rel="stylesheet" href="../CSS/cart.css" />
</head>
<body>

<header>
  <?php include '../PHP/header.php'; ?>
  <?php include '../PHP/processCheckout.php'; ?>
</header>

<main>
  <div class="mainContent">
    <?php if ($success): ?>
      <h2>Thank you for your order!</h2>
      <p>Your order has been successfully placed. We will contact you shortly with the details.</p>
      <a href="homepage.php" class="checkoutBtn">Return to Home</a>
    <?php else: ?>
      <h2>Checkout</h2>

      <?php if (!empty($errors)): ?>
        <div style="color: red; margin-bottom: 1rem;">
          <ul>
            <?php foreach ($errors as $err): ?>
              <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <h3>Order Summary</h3>
      <table class="cartTable">
        <tr>
          <th>Item</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Total</th>
        </tr>
        <?php foreach ($cart as $item): ?>
        <tr>
          <td><?= htmlspecialchars($item['item_name']) ?></td>
          <td><?= (int)$item['quantity'] ?></td>
          <td>$<?= number_format($item['price'], 2) ?></td>
          <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="totalRow">
          <td colspan="3"><strong>Subtotal</strong></td>
          <td><strong>$<?= number_format($subtotal, 2) ?></strong></td>
        </tr>
        <?php if ($discount > 0): ?>
        <tr class="discountRow">
          <td colspan="3"><strong>Discount</strong></td>
          <td><strong>-$<?= number_format($discount, 2) ?></strong></td>
        </tr>
        <tr class="finalTotalRow">
          <td colspan="3"><strong>Final Total</strong></td>
          <td><strong>$<?= number_format($finalTotal, 2) ?></strong></td>
        </tr>
        <?php endif; ?>
      </table>

      <form method="POST" action="checkout.php" novalidate>
        <h3>Delivery Method</h3>
        <div class="radioPillGroup">
          <input type="radio" id="delivery" name="delivery_method" value="delivery" <?= (($_POST['delivery_method'] ?? '') === 'delivery') ? 'checked' : '' ?>>
          <label for="delivery">Delivery</label>

          <input type="radio" id="pickup" name="delivery_method" value="pickup" <?= (($_POST['delivery_method'] ?? '') === 'pickup') ? 'checked' : '' ?>>
          <label for="pickup">Pickup</label>
        </div>

        <h3>Payment Details</h3>
        <div class="paymentDetailsCard">
          <div class="formRow">
            <div class="formGroup">
              <label for="name"><strong>Full Name</strong></label>
              <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? $userName) ?>" required>
            </div>
            <div class="formGroup">
              <label for="email"><strong>Email Address</strong></label>
              <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $userEmail) ?>" required>
            </div>
          </div>
          <br>
          <div id="addressSection">
            <label for="streetAddress"><strong>Delivery Address</strong></label>
            <input type="text" id="streetAddress" name="address" value="<?= htmlspecialchars($_POST['address'] ?? '') ?>" autocomplete="off">
            <div id="addressValidation"></div>
          </div>
          <br>
          <div id="paymentSection">
            <label>Payment Method</label>
            <div class="radioPillGroup">
              <input type="radio" id="card" name="payment" value="card" <?= (($_POST['payment'] ?? '') === 'card') ? 'checked' : '' ?> required>
              <label for="card">Credit/Debit Card</label>

              <input type="radio" id="paypal" name="payment" value="paypal" <?= (($_POST['payment'] ?? '') === 'paypal') ? 'checked' : '' ?> required>
              <label for="paypal">PayPal</label>

              <input type="radio" id="cash" name="payment" value="cash" <?= (($_POST['payment'] ?? '') === 'cash') ? 'checked' : '' ?> required>
              <label for="cash">Cash on Delivery</label>
            </div>
          </div>
        </div>
        <br>
        <button type="submit" class="checkoutBtn">Place Order</button>
      </form>
    <?php endif; ?>
  </div>
</main>

<footer>
  <script src="../JavaScript/checkout.js"></script>
  <script src="../JavaScript/footer.js"></script>
</footer>

</body>
</html>
