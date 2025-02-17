<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$entered_otp = $_POST['otp'] ?? '';

if (!isset($_SESSION['otp'])) {
    echo json_encode(["status" => "error", "message" => "No OTP found. Please request a new OTP."]);
    exit;
}

if ($entered_otp == $_SESSION['otp']) {
    echo json_encode(["status" => "success", "message" => "OTP verified successfully"]);
    unset($_SESSION['otp']);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid OTP. Please try again."]);
}
?>

