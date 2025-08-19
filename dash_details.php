<?php
include 'includes/connection.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
}
$sql = "SELECT * FROM db1 WHERE id = $id";
$data = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Death Person Details</title>
    <link rel="stylesheet" href="addash.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('https://cdn.wallpapersafari.com/26/4/MWqQB8.jpg') no-repeat center center/cover;
            margin: 0;
            padding: 20px;
        }

        .tables_details {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .last-request {
            width: 100%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            padding: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
            overflow-wrap: break-word;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .heading h2 {
            color: white;
            margin: 0;
        }

        .btn {
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: rgb(195, 183, 73);
        }

        .detail-item {
            background: rgb(112, 205, 197);
            margin: 10px 0;
            padding: 10px;
            border-left: 5px solid #007bff;
            font-size: 16px;
            color: #555;
            word-wrap: break-word;
        }

        .detail-item strong {
            color: #333;
        }

        .edit-status-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .edit-link {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
        }

        .edit-link:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .heading h2 {
                font-size: 18px;
            }

            .btn {
                padding: 8px 10px;
                font-size: 14px;
            }

            .detail-item {
                font-size: 14px;
            }

            .edit-link {
                font-size: 14px;
                padding: 6px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="tables_details">
        <div class="last-request">
            <div class="heading">
                <h2>Death Person Details</h2>
                <a href="dashboard.php" class="btn">Back</a>
            </div>
            <?php
            if ($data && mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_assoc($data)) {
                    echo "<div class='detail-item'><strong>ID:</strong> " . (!empty($row['id']) ? $row['id'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>Name:</strong> " . (!empty($row['username']) ? $row['username'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>D.O.B:</strong> " . (!empty($row['dateofbirth']) ? $row['dateofbirth'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>D.O.D:</strong> " . (!empty($row['deathdate']) ? $row['deathdate'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>Cause:</strong> " . (!empty($row['cause']) ? $row['cause'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>Address:</strong> " . (!empty($row['address']) ? $row['address'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>Laying Method:</strong> " . (!empty($row['layingmethod']) ? $row['layingmethod'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>Funeral Time:</strong> " . (!empty($row['burialtime']) ? $row['burialtime'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>Any Request:</strong> " . (!empty($row['anyrequest']) ? $row['anyrequest'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>Aadhar:</strong> " . (!empty($row['aadhar']) ? $row['aadhar'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>relation:</strong> " . (!empty($row['relation']) ? $row['relation'] : "Null") . "</div>";
                    echo "<div class='detail-item'><strong>relative description:</strong> " . (!empty($row['relative_description']) ? $row['relative_description'] : "Null") . "</div>";
                    if (!empty($row['aadhar_file'])) {
                        echo "<div class='detail-item'><strong>Aadhar Image:</strong> <a href='download.php?id=" . $row['id'] . "' target='_blank'>Download Aadhar</a></div>";
                    } else {
                        echo "<div class='detail-item'><strong>Aadhar Image:</strong> No File</div>";
                    }
                    echo "<div class='edit-status-container'>";
                    echo "<div class='detail-item'><strong>Status:</strong> " . $row['status'] . "</div>";
                    echo "<a class='edit-link' href='d_edit.php?id=" . $row['id'] . "'>Edit</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No data found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
