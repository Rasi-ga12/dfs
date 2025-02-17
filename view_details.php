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
        body {
            font-family: Arial, sans-serif;
            background: url('https://cdn.wallpapersafari.com/26/4/MWqQB8.jpg');
            margin: 0;
            padding: 20px;
        }
       /*.tables_details{
            background:url('https://cdn.wallpapersafari.com/26/4/MWqQB8.jpg') no-repeat;
            display: flex;
            flex-direction: column;
            height: 500px;
            width:600px;
            border:1px solid green;
            align-items: center;
            margin:auto;
            margin-top: 50px;
            border-radius: 25px;
        

}*/
       /* .tables_details {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }*/
        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .heading h2{
            color:white;
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
            background: #0056b3;
        }
        .btn-accept {
            background: green;
        }
        .btn-reject {
            background: red;
        }
        .detail-item {
            background:rgb(20, 218, 201);
            margin: 10px 0;
            padding: 10px;
            border-left: 5px solid #007bff;
            font-size: 16px;
            color: #555;
        }
        .detail-item strong {
            color: #333;
        }
        .last-request{
            background:url('https://cdn.wallpapersafari.com/26/4/MWqQB8.jpg') no-repeat;
            display: flex;
            flex-direction: column;
            height: 200px;
            width:600px;
            border:1px solid green;
            margin:auto;
            border-radius: 25px;
        
        }

    </style>
</head>
<body>
    <div class="tables_details">
        <div class="last-request">
            <div class="heading">
                <h2>Death Person Details</h2>
                <a href="admin.php" class="btn">Back</a>
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
                    if (!empty($row['aadhar_file'])) {
                        echo "<div class='detail-item'><strong>Aadhar Image:</strong> <a href='download.php?id=" . $row['id'] . "' target='_blank'>Download Aadhar</a></div>";
                    } else {
                        echo "<div class='detail-item'><strong>Aadhar Image:</strong> No File</div>";
                    }
                    echo "<div class='detail-item'><strong>Status:</strong> " . $row['status'] . "</div>";

                    echo "<form action='update_status.php' method='POST'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' name='accept' class='btn btn-accept'>Accept</button>
                        <button type='submit' name='reject' class='btn btn-reject'>Reject</button>
                    </form>";
                    if ($row['status'] === "Accepted") {
                        echo "<form action='update_status.php' method='POST' style='margin-top: 10px;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' name='complete' class='btn btn-complete'>Complete</button>
                        </form>";
                    }
                }
            } else {
                echo "<p>No data found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
