<?php
session_start();

// ✅ Debug: Check stored session values
print_r($_SESSION);

if (!isset($_SESSION['otp'])) {
    die("No OTP found. Request a new OTP.");
}

$entered_otp = $_POST['otp'];

if ($_SESSION['otp'] == $entered_otp && time() <= $_SESSION['otp_expiry']) {
    echo "OTP verified successfully!";

    // ✅ Ensure email is stored properly
    if (isset($_SESSION['email'])) {
        setcookie("user_email", $_SESSION['email'], time() + 3600, "/"); // Store in a cookie for 1 hour
        header("location:forget3.php");
        exit;
    } else {
        die("Email not found. Please try again.");
    }

    // ✅ Remove OTP after successful verification
    unset($_SESSION['otp']);
    unset($_SESSION['otp_expiry']);
} else {
    echo "Invalid or expired OTP.";
}
?>
