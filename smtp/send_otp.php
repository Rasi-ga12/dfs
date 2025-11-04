<?php
session_start();
require 'config.php';

// Manually include PHPMailer files
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Generate OTP
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;
$_SESSION['otp_expiry'] = time() + 300; // OTP expires in 5 minutes

$email = $_POST['email']; // Get email from form

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USER;
    $mail->Password = SMTP_PASS;
    $mail->SMTPSecure = 'tls';
    $mail->Port = SMTP_PORT;

    $mail->setFrom(SMTP_USER, 'Your Website');
    $mail->addAddress($email);
    $mail->Subject = 'Your OTP Code';
    $mail->Body = "Your OTP code is: $otp. It is valid for 5 minutes.";

    $mail->send();
    echo "OTP sent successfully!";
    $_SESSION['email']=$email;
    header('location:forget2.php');
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>
