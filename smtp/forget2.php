<?php
session_start();

// ✅ Restore email from cookie if session is lost
if (!isset($_SESSION['email']) && isset($_COOKIE['user_email'])) {
    $_SESSION['email'] = $_COOKIE['user_email'];
}

if (!isset($_SESSION['email'])) {
    die("Session expired. Please request a new OTP.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <form action="verify_otp.php" method="post" class="adminlog">
        <h3>Enter OTP:</h3>
        <input type="text" name="otp" class="box2" placeholder="Enter OTP" required>
        <button type="submit" id="submit">Verify OTP</button>
        <a href="send_otp.php" >Resend OTP</a>
    </form>   
</body>
</html>
