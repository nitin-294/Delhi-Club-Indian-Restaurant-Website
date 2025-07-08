<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="navbar">
    <img src="../Images/Logo.png" alt="Delhi Club Logo">
    <a href="homepage.php" <?= $currentPage === 'homepage.php' ? 'id="selected"' : '' ?>>Home</a>
    <a href="menu.php" <?= $currentPage === 'menu.php' ? 'id="selected"' : '' ?>>Menu</a>
    <a href="about.php" <?= $currentPage === 'about.php' ? 'id="selected"' : '' ?>>About Us</a>
    <?php
    
    $cartCount = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $cartCount += $item['quantity'];
        }
    }
    ?>

    <a href="shoppingCart.php" class="cartLink" <?= $currentPage === 'shoppingCart.php' ? 'id="selected"' : '' ?>>
    Cart 
    <img src="../Images/shoppingCartIcon.png" alt="shopping cart">
    <span id="cartCount" class="cart-count-badge"><?= $_SESSION['cart_count'] ?? 0 ?></span>
    </a>


    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="profile.php" <?= $currentPage === 'profile.php' ? 'id="selected"' : '' ?>>
            <?= htmlspecialchars($_SESSION['user_name']) ?>
        </a>
        <a href="../PHP/logout.php">Logout</a>
    <?php else: ?>
        <a href="signin.php" <?= $currentPage === 'signin.php' ? 'id="selected"' : '' ?>>Sign In</a>
    <?php endif; ?>
</div>
