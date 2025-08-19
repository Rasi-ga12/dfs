<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['Password'];
if($email==='admin123@gmail.com' and $password==='admin'){
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
        <a href="smtp/forget1.php">Forgot Password..?</a>
    </form>   
</body>
</html>