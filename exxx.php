if ($stmt->execute()) {
        $db2_id = $conn->insert_id;
    
        // Debug before redirection
        if (!empty($db2_id)) {
            header("Location: user1.php?db2_id=" . $db2_id);
            exit();
        } else {
            die("Error: db2_id is empty.");
        }
    } else {
        die("Failed to insert data: " . $stmt->error);
    }
*** index.php style***
    <style>
        body {
            font-family: 'Roboto Slab', serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .head1 p {
            color: black;
            font-size: 22px;
        }

        .head1 h1:hover {
            color: midnightblue;
        }

        .pos_cen {
            max-width: 90%;
            margin: 50px auto;
            background-color: rgba(42, 92, 61, 0.47);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .img_deg {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }

        .content-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }

        .content-text {
            flex: 1 1 300px;
            font-size: 18px;
            color: rgba(7, 5, 5, 0.87);
            text-indent: 40px;
            text-align: justify;
        }

        .more {
            color: purple;
        }

        .mission {
            max-width: 90%;
            margin: 40px auto 80px auto;
            text-align: center;
        }

        .mission h1 {
            color: #2a5c3d;
            font-weight: bold;
        }

        .mission h1:hover {
            color: crimson;
        }

        .mission1 h2 {
            color: rgb(237, 247, 240);
            background-color: #2a5c3d;
            padding: 10px;
            border-radius: 10px;
            margin: 15px auto 5px;
            max-width: 90%;
        }

        .mission1 p {
            text-align: justify;
            font-size: 16px;
            color: #333;
            margin: 0 auto 15px;
            max-width: 90%;
        }

        .let {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin: 30px;
        }

        .content {
            text-align: center;
        }

        .content h2, .content h4 {
            background-color: slategray;
            color: #fff;
            border-radius: 20px;
            padding: 15px;
            margin: 10px;
        }

        .content h4:hover {
            background-color: seagreen;
        }

        .people {
            font-size: 20px;
            color: green;
            border-radius: 30px;
            border: 2px solid #2a5c3d;
            box-shadow: 2px 2px 2px 2px;
            padding: 20px;
        }

        .people:hover {
            color: darkmagenta;
        }

        .imghelp_deg {
            width: 90%;
            max-width: 300px;
            border-radius: 30px;
            border: 1px solid #2a5c3d;
            box-shadow: 1px 2px 2px 2px;
            transition: 0.5s;
        }

        .descrip:hover {
            color: darkolivegreen;
        }

        #toTop {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #2a5c3d;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .bullet-text p {
            position: relative;
            padding-left: 20px;
            color: black;
            font-size: 20px;
            text-align: center;
        }

        .bullet-text p::before {
            content: "•";
            position: relative;
            left: 0;
            top: 0;
            color: #444;
            font-size: 35px;
            line-height: 1;
        }

        /* Responsive Tweaks */
        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
            }

            .content-text {
                text-indent: 20px;
            }

            .mission1 h2, .mission1 p {
                margin: 10px auto;
            }

            .people {
                font-size: 18px;
                padding: 15px;
            }

            .img_deg, .imghelp_deg {
                max-width: 100%;
                height: auto;
            }

            .let {
                flex-direction: column;
            }
        }
    </style>



<?php
session_start();
include('includes/connection.php');

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Check if the user has already submitted the form
$check_sql = "SELECT * FROM db2 WHERE email='$email'";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // Redirect to user1.php if the form has been submitted before
    header("location: user1.php");
    exit();
}

// Fetch user details for form validation
$sql = "SELECT * FROM users WHERE email='$email'";
$data = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($data);

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : '';
    if ($row['username'] != $name) {
        echo "<script>alert('Username does not match!');</script>";
    } else {
        $mobile_number = isset($_POST["phonenumber"]) ? trim($_POST["phonenumber"]) : '';
        $relation = isset($_POST["relation"]) ? trim($_POST["relation"]) : '';
        $relative_description = isset($_POST["relations"]) ? trim($_POST["relations"]) : '';
        $address = isset($_POST["address"]) ? trim($_POST["address"]) : '';
        $aadhar = isset($_POST["aadhar"]) ? trim($_POST["aadhar"]) : '';

        // File upload handling
        $allowed_formats = ['png', 'jpg', 'jpeg', 'pdf'];
        if (isset($_FILES["docu"]) && $_FILES["docu"]["error"] === UPLOAD_ERR_OK) {
            $filename = $_FILES["docu"]["name"];
            $file_tmp_name = $_FILES["docu"]["tmp_name"];
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (!in_array($extension, $allowed_formats)) {
                die("Invalid file format. Allowed formats are: png, jpg, jpeg, pdf.");
            }

            $file_content = file_get_contents($file_tmp_name);
        } else {
            die("A valid file must be uploaded.");
        }

        // Insert form data into the db2 table
        $stmt = $conn->prepare("INSERT INTO db2 (email, name, mobile_number, relation, relative_description, address, aadhar_number, aadhar_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("sssssssb", $email, $name, $mobile_number, $relation, $relative_description, $address, $aadhar, $file_content);
        $stmt->send_long_data(7, $file_content);

        if ($stmt->execute()) {
            header("Location: user1.php");
            exit();
        } else {
            die("Failed to insert data: " . $stmt->error);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Form</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <center>
        <form id="forms" action="user.php" method="POST" class="form" enctype="multipart/form-data">
            <h1 class="space">Applicant Form</h1>
            <table class="all" cellpadding="27" cellspacing="27" align="center">
                <tr>
                    <td>Your Name:</td>
                    <td><input type="text" class="form1" placeholder="Name" name="name" required></td>
                </tr>
                <tr>
                    <td>Your Mobile Number:</td>
                    <td><input type="text" class="form2" placeholder="Phone Number" name="phonenumber" required></td>
                </tr>
                <tr>
                    <td>Relation:</td>
                    <td>
                        <input type="radio" name="relation" value="relative" required> Relative
                        <input type="radio" name="relation" value="other person"> Other Person
                    </td>
                </tr>
                <tr>
                    <td>Your Address:</td>
                    <td><textarea name="address" required></textarea></td>
                </tr>
                <tr>
                    <td>Your Aadhar Number:</td>
                    <td><input type="text" class="form4" placeholder="Aadhar" name="aadhar" required></td>
                </tr>
                <tr>
                    <td>Upload Aadhar:</td>
                    <td><input type="file" name="docu" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" class="sub" value="Submit"></td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>
