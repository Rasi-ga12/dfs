<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'D:/xampp/htdocs/thaaimadi/vendor/PHPMailer-master/src/Exception.php';
require 'D:/xampp/htdocs/thaaimadi/vendor/PHPMailer-master/src/PHPMailer.php';
require 'D:/xampp/htdocs/thaaimadi/vendor/PHPMailer-master/src/SMTP.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$email = $_POST['email'] ?? '';

if (empty($email)) {
    echo json_encode(["status" => "error", "message" => "Email is required"]);
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tthaaimadi@gmail.com';
    $mail->Password = 'wplp kgwz ohih jzqj';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('tthaaimadi@gmail.com', 'My App Support');
    $mail->addAddress($email);

    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_email'] = $email;
    $_SESSION['otp_time'] = time(); 

    $mail->Subject = 'Your OTP Code';
    $mail->Body = "Your OTP code is: $otp. It is valid for 5 minutes.";
    $mail->send();

    echo json_encode(["status" => "success", "message" => "OTP sent successfully"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Mailer Error: " . $mail->ErrorInfo]);
}
?>
