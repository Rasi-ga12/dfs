<?php
session_start();
header('Content-Type: application/json');

// Restore session from cookie if missing
if (!isset($_SESSION['email']) && isset($_COOKIE['user_email'])) {
    $_SESSION['email'] = $_COOKIE['user_email'];
}

if (!isset($_SESSION['email'])) {
    echo json_encode(["status" => "error", "message" => "Session expired. Please request a new OTP."]);
    exit;
}

include('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["password"])) {
    $email = $_SESSION['email'];
    $newPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
    $stmt->bind_param("ss", $newPassword, $email);

    if ($stmt->execute()) {
        session_destroy();
        echo json_encode(["status" => "success", "message" => "Password reset successful! Redirecting to login..."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating password."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
