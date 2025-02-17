
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>

<div class="container">
    <h2>Reset Password</h2><br>
    <input type="password" id="password" placeholder="New Password"><br><br>
    <input type="password" id="confirm_password" placeholder="Confirm Password"><br><br>
    <button onclick="resetPassword()">Reset Password</button>
</div>

<script>
    function resetPassword() {
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("confirm_password").value;

        if (password === "" || confirmPassword === "") {
            alert("Please enter and confirm your new password.");
            return;
        }
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return;
        }

        let formData = new FormData();
        formData.append("password", password);

        fetch("reset_password.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => console.error("Error:", error));
    }
</script>

</body>
</html>
