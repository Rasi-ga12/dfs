<?php
session_start();
include('includes/connection.php'); // Database connection

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user details from the database
    $query = "SELECT ID, Password FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $ret = $result->fetch_assoc();

    if ($ret && password_verify($password, $ret['Password'])) {
        $_SESSION['pgasoid'] = $ret['ID'];
        $_SESSION['email'] = $email;

        // Check if email is already registered in db2
        $check_sql = "SELECT * FROM db2 WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            echo "<script>alert('You have already registered');</script>";
            header('location:mem_dashboard.php');
            exit();
        } else {
            $_SESSION['email'] = $email;
            header('location:member.php');
            exit();
        }
    } else {
        echo "<script>alert('Invalid details');</script>";
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
            <form action="log.php" method="post">
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