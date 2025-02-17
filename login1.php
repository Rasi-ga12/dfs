<?php
session_start();
include('includes/connection.php'); // Include database connection

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch the user based on the email
    $query = mysqli_query($conn, "SELECT ID, Password FROM users WHERE Email='$email'");
    $data=mysqli_query($conn,"SELECT id from db2 where email='$email'");
    $ret = mysqli_fetch_assoc($query);
    $ans=mysqli_fetch_assoc($data);

    // Validate the password
    if ($ret && password_verify($password, $ret['Password']) && $ans) {
        $_SESSION['pgasoid'] = $ans['id'];
        $_SESSION['email'] = $email;// Store user ID in session
        header('location:dashboard.php'); // Redirect to signup.php
        exit();
    } else {
        echo "<script>alert('Invalid Details.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-box login">
            <h2>Login</h2>
            <form action="login1.php" method="post">
                <div class="input-box1">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <label>Email</label>
                    <input type="email" class="login1" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box2">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <label>Password</label>
                    <input type="password" class="login2"name="password" placeholder="Enter your password" required>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="user/forgot.php">Forgot Password..?</a>
                </div>
                <button type="submit" name="login" class="btn">Login</button>
                <div class="signup">
                    <p>Don't have an account? <a href="signup.php" class="Signup-link">Sign up</a></p>
                </div>
                <div class="home">
                    <a href="index.php" class="homepage">Home page</a>
</div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>