<?php
session_start();
include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: ../HTML/signin.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT id, email, password, first_name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'];
            header("Location: ../HTML/homepage.php");
            exit;
        } else {
            $_SESSION['error'] = "Incorrect Password.";
        }
    } else {
        $_SESSION['error'] = "Incorrect Email";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../HTML/signin.php");
    exit;
} else {
    header("Location: ../HTML/signin.php");
    exit;
}
?>
