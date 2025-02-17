<?php
ob_start(); // Start output buffering
session_start();
include('includes/connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT ID, Password FROM users WHERE Email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $ret = $result->fetch_assoc();

    if ($ret && password_verify($password, $ret['Password'])) {
        $_SESSION['pgasoid'] = $ret['ID'];
        $_SESSION['email'] = $email;

        $check_sql = "SELECT id FROM db2 WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $row = $check_result->fetch_assoc();
            $db2_id = $row['id'];

            if (!isset($db2_id) || empty($db2_id)) {
                die("Error: db2_id is missing.");
            }

            ob_clean(); // Ensure no previous output
            

            header("Location: user1.php?db2_id=" . $db2_id);
            exit();
        } else {
            header("Location: user.php");
            exit();
        }
    } else {
        echo "<script>alert('Invalid Details.'); window.location.href='login.php';</script>";
        exit();
    }
}
ob_end_flush(); // Flush buffer and send headers
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
            <form action="login.php" method="post">
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
                    <a href="smtp/forget1.php">Forgot Password..?</a>
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