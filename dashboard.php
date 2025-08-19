<?php
session_start();
include('includes/connection.php'); 

if (!isset($_SESSION['pgasoid'])) {
    header("location: login.php");
    exit();
}

$email = $_SESSION['email'];
$id = $_SESSION['pgasoid'];

$data = mysqli_query($conn, "SELECT * FROM db2 WHERE email='$email' ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <style>
        body {
            background: url('https://cdn.wallpapersafari.com/26/4/MWqQB8.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0px;
        }

        .tables {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
        }

        .last-request {
            width: 90%;
            background: white;
            padding: 30px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        .heading h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .Requests {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto;
        }

        .Requests thead {
            background: rgb(76, 184, 151);
            color: black;
            height: 50px;
        }

        .Requests thead th {
            padding: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .Requests tr {
            transition: 0.3s ease-in-out;
        }

        .Requests tr:nth-child(even) {
            background-color: rgb(229, 239, 226);
        }

        .Requests tr:hover {
            background: rgba(0, 123, 255, 0.2);
        }

        .Requests td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        a {
            text-decoration: none;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        a:hover {
            opacity: 0.8;
        }

        a[href*="edit.php"] {
            background-color: #007bff;
            color: white;
        }

        a[href*="download.php"] {
            background-color: #28a745;
            color: white;
        }

        @media (max-width: 768px) {
            .last-request {
                width: 100%;
                padding: 15px;
                box-sizing: border-box;
            }

            .Requests thead {
                display: none;
            }

            .Requests tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 8px;
                padding: 10px;
                background-color: #f9f9f9;
            }

            .Requests td {
                display: block;
                text-align: left;
                font-size: 14px;
                padding: 8px;
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
            }

            .Requests td:before {
                content: attr(data-label);
                font-weight: bold;
                display: inline-block;
                width: 50%;
            }

            a {
                display: inline-block;
                margin-top: 5px;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="tables">
    <div class="last-request">
        <div class="heading">
            <h2>Your Details</h2>
        </div>

        <?php
        if ($data && mysqli_num_rows($data) > 0) {
            echo "<div class='table-wrapper'><table class='Requests'>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Address</th>
                            <th>Aadhar No</th>
                            <th>Aadhar Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = mysqli_fetch_assoc($data)) {
                echo "<tr>
                        <td data-label='Id'>" . (!empty($row['id']) ? $row['id'] : "Null") . "</td>
                        <td data-label='Name'>" . (!empty($row['name']) ? $row['name'] : "Null") . "</td>
                        <td data-label='Mobile Number'>" . (!empty($row['mobile_number']) ? $row['mobile_number'] : "Null") . "</td>
                        <td data-label='Address'>" . (!empty($row['address']) ? $row['address'] : "Null") . "</td>
                        <td data-label='Aadhar No'>" . (!empty($row['aadhar_number']) ? $row['aadhar_number'] : "Null") . "</td>";

                if (!empty($row['aadhar_file'])) {
                    echo "<td data-label='Aadhar Image'><a href='download.php?id=" . $row['id'] . "' target='_blank'>Download Aadhar</a></td>";
                } else {
                    echo "<td data-label='Aadhar Image'>No File</td>";
                }

                echo "<td data-label='Action'><a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>";
                echo "</tr>";
            }

            echo "</tbody></table></div>";
        } else {
            echo "<p>No records found.</p>";
        }
        ?>
    </div>
</div>

<?php include("user_request.php"); ?>

<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
