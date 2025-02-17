<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['test'])) {
    echo "Session Value: " . $_SESSION['test'];
} else {
    echo "Session is NOT working!";
}
?>
