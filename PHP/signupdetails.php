<?php
session_start();
include 'dbConnection.php';

$firstName = trim($_POST['firstName'] ?? '');
$lastName = trim($_POST['lastName'] ?? '');
$email = trim($_POST['email'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';
$captcha = trim($_POST['captcha'] ?? '');

if (!$firstName || !$lastName || !$email || !$username || !$password || !$confirmPassword || !$captcha) {
    $_SESSION['error'] = "Please fill in all fields.";
    header("Location: ../HTML/signup.php");
    exit;
}

if ($password !== $confirmPassword) {
    $_SESSION['error'] = "Passwords do not match.";
    header("Location: ../HTML/signup.php");
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
$stmt->bind_param("ss", $email, $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['error'] = "Email or username already exists. Please use another.";
    $stmt->close();
    header("Location: ../HTML/signup.php");
    exit;
}
$stmt->close();

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, username, password, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("sssss", $firstName, $lastName, $email, $username, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['success'] = "Account created successfully! Please sign in.";
    $stmt->close();
    header("Location: ../HTML/signup.php");
    exit;
} else {
    $_SESSION['error'] = "An error occurred. Please try again.";
    $stmt->close();
    header("Location: ../HTML/signup.php");
    exit;
}
?>
