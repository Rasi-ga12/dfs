<?php
session_start();

// ✅ Restore session if lost
if (!isset($_SESSION['email']) && isset($_COOKIE['user_email'])) {
    $_SESSION['email'] = $_COOKIE['user_email']; // Restore from cookie
}

if (!isset($_SESSION['email'])) {
    die("Session expired. Please request a new OTP.");
}

include('../includes/connection.php'); // Ensure this file exists

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["password"])) {
    $email = $_SESSION['email']; // Ensure email is set
    $newPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
    $stmt->bind_param("ss", $newPassword, $email);

    if ($stmt->execute()) {
        echo "success";
        session_destroy(); 
        header('location:http://localhost/thaaimadi/login.php')// Destroy session after password reset
    } else {
        echo "Error updating password.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
