<?php
// Database connection
$servername = "localhost:3306";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password is empty
$dbname = "dfs"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Debugging line to ensure the connection works
?>