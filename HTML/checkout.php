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
      <div class="receiptContainer">
        <h2>🧾 Order Receipt</h2>
        <p><strong>Delhi Club Indian Restaurant</strong></p>
        <p>Date: <?= date('d M Y, h:i A') ?></p>
        <p>Order #: <?= isset($_SESSION['last_order_id']) ? 'ORD' . $_SESSION['last_order_id'] : 'N/A' ?></p>
        <hr>

        <h3>Order Summary</h3>
        <table class="cartTable receiptTable">
          <thead>
            <tr>
              <th>Item</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cart as $item): ?>
            <tr>
              <td><?= htmlspecialchars($item['item_name']) ?></td>
              <td><?= (int)$item['quantity'] ?></td>
              <td>$<?= number_format($item['price'], 2) ?></td>
              <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="subtotalRow">
              <td colspan="3" style="text-align:right;"><strong>Subtotal</strong></td>
              <td><strong>$<?= number_format($subtotal, 2) ?></strong></td>
            </tr>
            <?php if ($discount > 0): ?>
            <tr class="discountRow">
              <td colspan="3" style="text-align:right;"><strong>Discount</strong></td>
              <td><strong>-$<?= number_format($discount, 2) ?></strong></td>
            </tr>
            <?php endif; ?>
            <tr class="totalRow">
              <td colspan="3" style="text-align:right;"><strong>Final Total</strong></td>
              <td><strong>$<?= number_format($finalTotal, 2) ?></strong></td>
            </tr>
          </tbody>
        </table>

        <hr>
        <h3>Customer Information</h3>
        <p><strong>Name:</strong> <?= htmlspecialchars($_POST['name'] ?? '') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($_POST['email'] ?? '') ?></p>
        <p><strong>Delivery Method:</strong> <?= htmlspecialchars($_POST['delivery_method'] ?? '') ?></p>
        <?php if ($_POST['delivery_method'] === 'delivery'): ?>
          <p><strong>Address:</strong> <?= htmlspecialchars($_POST['address'] ?? '') ?></p>
        <?php endif; ?>

        <h3>Payment Method</h3>
        <p><?= htmlspecialchars(ucfirst($_POST['payment'] ?? '')) ?></p>

        <hr>
        <p>Thank you for ordering with Delhi Club Indian Restaurant</p>
        <br>
        <a href="homepage.php" class="checkoutBtn">Return to Home</a>
      </div>
    <?php else: ?>


      <h2>Checkout</h2>
      <table class="cartTable">
        <tr>
          <th>Item</th>
          <th>Quantity</th>
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
          <input type="radio" id="pickup" name="delivery_method" value="pickup"
            <?= (($_POST['delivery_method'] ?? '') === 'pickup' || !isset($_POST['delivery_method'])) ? 'checked' : '' ?> required>
          <label for="pickup">Pickup</label>

          <input type="radio" id="delivery" name="delivery_method" value="delivery"
            <?= (($_POST['delivery_method'] ?? '') === 'delivery') ? 'checked' : '' ?> required>
          <label for="delivery">Delivery</label>
        </div>
        <div class="fieldError" id="deliveryError" style="display:none;"></div>

        <h3>Payment Details</h3>
        <div class="paymentDetailsCard">
          <div class="formRow">
            <div class="formGroup">
              <label for="name"><strong>Full Name</strong></label>
              <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? $userName) ?>" required>
              <div class="fieldError" id="nameError" style="display:none;"></div>
            </div>
            <div class="formGroup">
              <label for="email"><strong>Email Address</strong></label>
              <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $userEmail) ?>" required>
              <div class="fieldError" id="emailError" style="display:none;"></div>
            </div>
          </div>

          <br>
          <div id="addressSection" style="display:none; position: relative;">
            <label for="streetAddress"><strong>Delivery Address</strong></label>
            <input type="text" id="streetAddress" name="address" autocomplete="off"
              value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
            <div class="fieldError" id="addressError" style="display:none;"></div>
            <div id="addressValidation"></div>
          </div>

          <div id="paymentSection">
            <h3>Payment Method</h3>
            <div class="radioPillGroup">
              <input type="radio" id="card" name="payment" value="card"
                <?= (($_POST['payment'] ?? '') === 'card' || !isset($_POST['payment'])) ? 'checked' : '' ?> required>
              <label for="card">Credit/Debit Card</label>

              <input type="radio" id="paypal" name="payment" value="paypal"
                <?= (($_POST['payment'] ?? '') === 'paypal') ? 'checked' : '' ?> required>
              <label for="paypal">PayPal</label>

              <input type="radio" id="cash" name="payment" value="cash"
                <?= (($_POST['payment'] ?? '') === 'cash') ? 'checked' : '' ?> required>
              <label for="cash">Cash on Delivery</label>
            </div>
            <div class="fieldError" id="paymentError" style="display:none;"></div>
          </div>

          <div id="cardDetails" style="display: none;">
            <div class="formRow">
              <div class="formGroup">
                <label for="cardNumber"><strong>Card Number</strong></label>
                <input type="text" id="cardNumber" name="card_number" maxlength="19" placeholder="1234 5678 9012 3456" value="<?= htmlspecialchars($_POST['card_number'] ?? '') ?>">
                <div class="fieldError" id="cardNumberError" style="display:none;"></div>
              </div>
              <div class="formGroup">
                <label for="expiryDate"><strong>Expiry Date</strong></label>
                <input type="text" id="expiryDate" name="expiry_date" maxlength="5" placeholder="MM/YY" value="<?= htmlspecialchars($_POST['expiry_date'] ?? '') ?>">
                <div class="fieldError" id="expiryDateError" style="display:none;"></div>
              </div>
              <div class="formGroup">
                <label for="cvv"><strong>CVV</strong></label>
                <input type="text" id="cvv" name="cvv" maxlength="3" placeholder="123" value="<?= htmlspecialchars($_POST['cvv'] ?? '') ?>">
                <div class="fieldError" id="cvvError" style="display:none;"></div>
              </div>
            </div>
          </div>
        </div>
        <br><br>
        <button type="submit" class="checkoutBtn" id="submitBtn">Place Order</button>
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
