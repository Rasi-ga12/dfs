<?php 
$msg = "";
include('includes/connection.php'); // Make sure this file has correct DB connection

if (isset($_POST['submit'])) {
    $fname = $_POST['username'];
    $mobno = $_POST['mobilenumber'];  // Fixed the typo here
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Use password_hash() for better security

    // Check if email already exists in the database
    $ret = mysqli_query($conn, "SELECT Email FROM users WHERE Email='$email'");
    $result = mysqli_fetch_array($ret);

    if ($result) {  // Check if result is found
        $msg = "This email or Mobile Number is already associated with another account";
    } else {
        // Insert the new user data into the database
        $query = mysqli_query($conn, "INSERT INTO users (username, mobilenumber, email, password) 
                                    VALUES ('$fname', '$mobno', '$email', '$password')");
        if ($query) {
            $msg = "You have successfully registered";
        } else {
            $msg = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css">
    <script src="js/jquery2.0.3.min.js"></script>
    <script type="text/javascript">
        function checkpass() {
            const password = document.signup.password.value;
            const repeatPassword = document.signup.repeatpassword.value;

            if (password !== repeatPassword) {
                alert('Password and Repeat Password fields do not match');
                document.signup.repeatpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="signup form">
    <div class="signup">
        <h1>Signup</h1>
        <p style="font-size:16px; color:red"> 
            <?php if($msg) { echo $msg; } ?> 
        </p>
        <form name="signup" action="signup.php" method="post" onsubmit="return checkpass();">
            <p>User Name:</p>
            <input type="text" name="username" placeholder="User Name" required>
            <p>Mobile Number:</p>
            <input type="text" name="mobilenumber" placeholder="Mobile Number" required>
            <p>Email:</p>
            <input type="email" name="email" placeholder="Email" required>
            <p>Password:</p>
            <input type="password" name="password" placeholder="Password" required>
            <p>Repeat Password:</p>
            <input type="password" name="repeatpassword" placeholder="Repeat Password" required>
            <button type="submit" name="submit" >SignUp</button>
            <div class=home1>
            <p>Do you have an account? <a href="login.php" class="Signup-link">Login</a></p>
            </div>
    </div>
   
</div>


</form>

</body>
</html>