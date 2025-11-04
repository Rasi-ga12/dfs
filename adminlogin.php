<?php
require_once "env_loader.php";

// Load .env
loadEnv(__DIR__ . '/.env');
$adminUser = $_ENV['ADMIN_USERNAME'];
$adminPass = $_ENV['ADMIN_PASSWORD'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['Password'];
if($email=== $adminUser and $password===$adminPass){
 header('location:admin.php');
}
else{
    echo "<script> alert('Invalid details'); </script>";

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adlogin</title>
    <link rel="stylesheet" href="user/user.css">
</head>
<body>
    <form action="adminlogin.php" class="adminlog" method="post">
        <h1>Sign In</h1>
        <input type="email" name="email" class="box2" placeholder="Enter Username">
        <input type="password" name="Password" class="box2"  placeholder="Enter Password">
        <input type="submit" id="submit" value="Sign In">
    </form>   
</body>
</html>