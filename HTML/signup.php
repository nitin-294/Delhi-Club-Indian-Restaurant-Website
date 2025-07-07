<?php
session_start();

$errorMsg = $_SESSION['error'] ?? '';
$successMsg = $_SESSION['success'] ?? '';

unset($_SESSION['error']);
unset($_SESSION['success']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delhi Club Indian Restaurant - Sign Up</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/signin.css">
</head>

<body>

<header>
    <?php include '../PHP/header.php'; ?>
</header>

<main>
    <div class="mainContent signup-container">
        <form id="signUpForm" class="formContainer" action="../PHP/signupdetails.php" method="post">
            <h2>Sign Up</h2>

            <div class="vertical-input-group">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" placeholder="First Name" >
            </div>
            <div id="firstNameError" class="errorMessage"></div>
            
            <div class="vertical-input-group">
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" placeholder="Last Name" >
            </div>
            <div id="lastNameError" class="errorMessage"></div>

            <div class="vertical-input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" >
            </div>
            <div id="emailError" class="errorMessage"></div>

            <div class="vertical-input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Username" >
            </div>
            <div id="usernameError" class="errorMessage"></div>

            <div class="vertical-input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password" >
            </div>
            <div id="passwordError" class="errorMessage"></div>

            <div class="vertical-input-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" >
            </div>
            <div id="confirmPasswordError" class="errorMessage"></div>
            
            <div class="vertical-input-group">
                <label for="captcha">Captcha:</label>
                <input type="text" name="captcha" id="captcha" placeholder="Enter the Captcha text" >
            </div>
            <div id="captchaError" class="errorMessage"></div>

            <div id="captchaText"></div>
            <script src="../JavaScript/captcha.js"></script>

            <?php if ($errorMsg): ?>
                <p class="errorMessage" style="text-align:center;"><?php echo htmlspecialchars($errorMsg); ?></p>
            <?php endif; ?>

            <?php if ($successMsg): ?>
                <p class="successMessage" style="text-align:center; color: green;"><?php echo htmlspecialchars($successMsg); ?></p>
            <?php endif; ?>

            <button type="submit" class="btn">Create Account</button>
            <br>
            <span>Already have an account? <a href="signin.php">Sign In</a></span>
        </form>
        <script src="../JavaScript/signUpValidation.js"></script>
    </div>
</main>

<footer>
    <script src="../JavaScript/footer.js"></script>
</footer>

</body>
</html>
