<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['test'] = "Session is working!";
echo "Session stored!";
?>

