<?php
session_start();
$errorMsg = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delhi Club Indian Restaurant - Sign In</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/signin.css">
</head>

<body>

<header>
    <?php include '../PHP/header.php'; ?>
</header>

<main>
    <div class="mainContent signin-container">
        <h2>Sign In</h2>

        <form action="../PHP/signinHandler.php" method="post">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <?php if ($errorMsg): ?>
                <p class="errorMessage" style="text-align:center;"><?php echo htmlspecialchars($errorMsg); ?></p>
            <?php endif; ?>

            <div class="forgot-link">
                <a href="forgotPassword.php">Forgot password?</a>
            </div>

            <button type="submit">Sign In</button>

            <p class="signup-link">Don't have an account? <a href="signup.php">Sign up</a></p>
        </form>

    </div>
</main>

<footer>
    <script src="../JavaScript/footer.js"></script>
</footer>

</body>
</html>
