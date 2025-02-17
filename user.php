<?php
ob_start(); // Start output buffering
session_start();
include('includes/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user details
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$data = $stmt->get_result();
$row = $data->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : '';
    $mobile_number = isset($_POST["phonenumber"]) ? trim($_POST["phonenumber"]) : '';
    $address = isset($_POST["address"]) ? trim($_POST["address"]) : '';
    $aadhar = isset($_POST["aadhar"]) ? trim($_POST["aadhar"]) : '';

    // Validate mandatory fields
    if (empty($name) || empty($mobile_number) || empty($address) || empty($aadhar)) {
        die("All fields are required.");
    }

    // Validate username
    if ($row['username'] !== $name) {
        echo "<script>alert('Username does not match!'); window.history.back();</script>";
        exit();
    }

    // File upload handling
    $allowedformat = ['png', 'jpg', 'jpeg', 'pdf'];
    if (isset($_FILES["docu"]) && $_FILES["docu"]["error"] === UPLOAD_ERR_OK) {
        $filename = $_FILES["docu"]["name"];
        $filetmpname = $_FILES["docu"]["tmp_name"];
        $filesize = $_FILES["docu"]["size"];

        // Limit file size to 2MB
        if ($filesize > 2 * 1024 * 1024) {
            die("File size exceeds 2MB limit.");
        }

        $extractextension = explode(".", $filename);
        $extension = strtolower(end($extractextension));

        if (!in_array($extension, $allowedformat)) {
            die("Invalid file format. Allowed formats are: png, jpg, jpeg, pdf.");
        }

        $filecontent = file_get_contents($filetmpname);
    } else {
        die("A valid file must be uploaded.");
    }

    $stmt = $conn->prepare("INSERT INTO db2 (name, mobile_number, address, aadhar_number, email, aadhar_file) VALUES (?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }
    
    // Bind parameters correctly (6 values, including the file)
    $stmt->bind_param("sssssb", $name, $mobile_number, $address, $aadhar, $email, $filecontent);
    
    // Send the BLOB data separately
    $stmt->send_long_data(5, $filecontent);
    

    if ($stmt->execute()) {
        $db2_id = $stmt->insert_id; // Get last inserted ID
        header("Location: user1.php?db2_id=" . $db2_id);
        exit();
    } else {
        die("Failed to insert data: " . $stmt->error);
    }
}

ob_end_flush(); // Flush output buffer
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="user.css">
    <script>
        function validatingInput(field) {
            var attname = field.name;
            var attvalue = field.value;
            var error = document.getElementById(attname + "Error");
            var isValid = true;

            switch (attname) {
                case "name":
                    if (attvalue.trim() == "") {
                        error.textContent = "Name must be filled out";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;
                case "phonenumber":
                    var phonepattern = /^[0-9]{10}$/;
                    if (!phonepattern.test(attvalue) || attvalue == "") {
                        error.textContent = "Invalid phone number";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;
                case "address":
                    if (attvalue.trim() == "") {
                        error.textContent = "Address must be filled out";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;
                case "aadhar":
                    var aadharpattern = /^[2-9]{1}[0-9]{11}$/;
                    if (!aadharpattern.test(attvalue) || attvalue == "") {
                        error.textContent = "Invalid Aadhar number";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;
                case "docu":
                    if (field.files.length === 0) {
                        error.textContent = "Upload a file";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;
            }
            return isValid;
        }

        function formvalidate(event) {
            var isValid = true;
            var inputs = document.querySelectorAll("input, textarea");

            inputs.forEach(function(input) {
                if (!validatingInput(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
            return isValid;
        }
    </script>
</head>
<body>
<center>
    <form id="forms" action="user.php" method="POST" class="form" enctype="multipart/form-data" onsubmit="return formvalidate(event)">
        <h1 class="space">Applicant Form</h1>
        <div class="wrapper">
            <table class="all" cellpadding="27" cellspacing="27" align="center">
                <tr>
                    <td>Your Name:</td>
                    <td>
                        <input type="text" class="form1" placeholder="Name" name="name" oninput="return validatingInput(this)">
                        <span id="nameError"></span>
                    </td>
                </tr>
                <tr>
                    <td>Your Mobile Number:</td>
                    <td>
                        <input type="text" class="form2" placeholder="Phone Number" name="phonenumber" oninput="return validatingInput(this)">
                        <span id="phonenumberError"></span>
                    </td>
                </tr>
                <tr>
                    <td>Your Address:</td>
                    <td>
                        <textarea name="address" oninput="return validatingInput(this)"></textarea>
                        <span id="addressError"></span>
                    </td>
                </tr>
                <tr>
                    <td>Your Aadhar Number:</td>
                    <td>
                        <input type="text" class="form4" placeholder="Aadhar" name="aadhar" oninput="return validatingInput(this)">
                        <span id="aadharError"></span>
                    </td>
                </tr>
                <tr>
                    <td>Upload Aadhar:</td>
                    <td>
                        <label for="uploadbtn">Upload File</label>
                        <input type="file" id="uploadbtn" name="docu" onchange="return validatingInput(this)">
                        <span id="docuError"></span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" class="sub">
                    </td>
                </tr>
            </table>
        </div>
    </form>
</center>
</body>
</html>
