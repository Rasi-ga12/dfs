<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["password"])) {
    if (!isset($_SESSION['email'])) {
        echo "Session expired. Please request a new OTP.";
        exit;
    }

    $email = $_SESSION['email'];
    $newPassword = password_hash($_POST["password"], PASSWORD_BCRYPT); // Encrypt password

    // Simulate saving the password (Replace this with actual database update)
    // Example SQL: UPDATE users SET password='$newPassword' WHERE email='$email';
    
    echo "Password reset successful! You can now log in.";

    // Destroy session after reset
    session_destroy();
} else {
    echo "Invalid request.";
}
?>
