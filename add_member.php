<?php
session_start();
include('includes/connection.php');



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : '';
    $mobile_number = isset($_POST["phonenumber"]) ? trim($_POST["phonenumber"]) : '';
    $address = isset($_POST["address"]) ? trim($_POST["address"]) : '';
    $aadhar = isset($_POST["aadhar"]) ? trim($_POST["aadhar"]) : '';

    // Allowed file formats
    $allowedformat = ['png', 'jpg', 'jpeg', 'pdf'];
    $filecontent = null;

    // Check if file is uploaded
    if (isset($_FILES["docu"]) && $_FILES["docu"]["error"] === UPLOAD_ERR_OK) {
        $filename = $_FILES["docu"]["name"];
        $filetmpname = $_FILES["docu"]["tmp_name"];
        $extractextension = explode(".", $filename);
        $extension = strtolower(end($extractextension));
        $status='Accepted';

        if (!in_array($extension, $allowedformat)) {
            die("Invalid file format. Allowed formats are: png, jpg, jpeg, pdf.");
        }

        if (!file_exists($filetmpname) || filesize($filetmpname) == 0) {
            die("File upload failed: File does not exist or is empty.");
        }

        $filecontent = file_get_contents($filetmpname);
    } else {
        die("A valid file must be uploaded.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO member (name, mobile_number, address, aadhar_number, aadhar_file,status) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $name, $mobile_number, $address, $aadhar, $filecontent,$status);
    $stmt->send_long_data(4, $filecontent);

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
        $sql1 = "UPDATE member SET status='Accepted' WHERE id=$id";
        header("Location:admin.php");
        exit();
    } else {
        die("Failed to insert data: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="user.css">
    <script>
        function validatingInput(field) {
            var attname = field.name;
            var attvalue = field.value;
            var error = document.getElementById(attname + "Error");
            var isValid = true;

            switch (attname) {
                case "name":
                    if (attvalue.trim() === "") {
                        error.textContent = "Name must be filled out";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;

                case "phonenumber":
                    var phonepattern = /^[0-9]{10}$/;
                    if (!phonepattern.test(attvalue) || attvalue === "") {
                        error.textContent = "Invalid phone number";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;

                case "address":
                    if (attvalue.trim() === "") {
                        error.textContent = "Address must be filled out";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;

                case "aadhar":
                    var aadharpattern = /^[2-9]{1}[0-9]{11}$/;
                    if (!aadharpattern.test(attvalue) || attvalue === "") {
                        error.textContent = "Invalid Aadhar";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;

                case "docu":
                    if (field.files.length === 0) {
                        error.textContent = "Upload the file";
                        isValid = false;
                    } else {
                        error.textContent = "";
                    }
                    break;
            }

            return isValid;
        }

        function formvalidate(event) {
            var form = document.getElementById("forms");
            var isValid = true;

            for (var i = 0; i < form.elements.length; i++) {
                var field = form.elements[i];
                if (field.type !== "submit" && !validatingInput(field)) {
                    isValid = false;
                }
            }

            if (isValid) {
                return true;
            } else {
                event.preventDefault();
                return false;
            }
        }
    </script>
</head>
<body>
    <center>
        <form id="forms" action="add_member.php" method="POST" class="form" enctype="multipart/form-data" onsubmit="return formvalidate(event)">
        <h1 class="space">Application Form</h1>  
        <div class="wrapper">
                
                <table class="all" cellpadding="27" cellspacing="27" align="center">
                    <tr>
                        <td>Member Name:</td>
                        <td>
                            <input type="text" class="form1" placeholder="Name" name="name" oninput="return validatingInput(this)">
                            <span id="nameError"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Member Mobile Number:</td>
                        <td>
                            <input type="text" class="form2" placeholder="Phone Number" name="phonenumber" oninput="return validatingInput(this)">
                            <span id="phonenumberError"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Member Address:</td>
                        <td>
                            <textarea name="address" oninput="return validatingInput(this)"></textarea>
                            <span id="addressError"></span>
                        </td>
                    </tr>
                    <tr>
                        <td> Aadhar Number:</td>
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
                        <td><input type="submit" class="sub"></td>
                    </tr>
                </table>
            </div>
        </form>
    </center>
</body>
</html>
