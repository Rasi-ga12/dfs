<?php
session_start();
include('includes/connection.php'); // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['pgasoid'])) {
    header("location: login.php"); // Redirect to login if not logged in
    exit();
}

// Get the user ID from the session
$email = $_SESSION['email'];
$id=$_SESSION['pgasoid'];

// Fetch all user details from the database
$data= mysqli_query($conn, "SELECT * FROM db2 WHERE email='$email' ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user panel</title>
    <link rel="stylesheet" href="addash.css">
    <style>
    /* General Styling */
body {
     background: url('https://cdn.wallpapersafari.com/26/4/MWqQB8.jpg') no-repeat center center fixed;

    font-family: 'Arial', sans-serif;
  
    margin: 0;
    padding: 20px;
}

/* Table Styling */
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

/* Table */
.Requests {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    overflow-x: auto;
}

.Requests thead {
    background:rgb(76, 184, 151);
    color: black;
    height:50px;

}

.Requests thead td {
    padding: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.Requests tr {
    transition: 0.3s ease-in-out;
}

.Requests tr:nth-child(even) {
    background-color:rgb(229, 239, 226);
}

.Requests tr:hover {
    background: rgba(0, 123, 255, 0.2);
}

.Requests td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

/* Buttons */
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

/* Responsive Design */
@media (max-width: 768px) {
    .last-request {
        width: 100%;
        padding: 15px;
    }
    
    .Requests td {
        font-size: 14px;
        padding: 8px;
    }
}


    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
        <!--<?php include("admin/header.php");?>-->
            <div class="tables">
                <div class="last-request">
                    <div class="heading">
                        <h2>Your Details</h2>
                    </div>
                    <?php
                    if($data) 
                    {
                     echo "<table class='Requests'>
                        <thead>
                            <td> id </td>
                            <td> Name</td>
                            <td> Mobile number</td>
                            <td> Address</td>
                            <td> Aadhar No</td>
                            <td> Aadhar image</td>
                            </thead>";
                        while ($row = mysqli_fetch_assoc($data)) {
                        echo "<tr>
                                <td>" . (!empty($row['id']) ? $row['id'] : "Null")  . "</td>
                                <td>" . (!empty($row['name'])?$row['name']:"Null") . "</td>  
                                <td>" . (!empty($row['mobile_number'])?$row['mobile_number']:"Null"). "</td>
                                <td>" . (!empty($row['address'])?$row['address']:"Null"). "</td> 
                                <td>" . (!empty($row['aadhar_number'])?$row['aadhar_number']:"Null"). "</td>";
                                if (!empty($row['aadhar_file'])) {
                                    echo "<td><a href='download.php?id=" . $row['id'] . "' target='_blank'>Download Aadhar</a></td>";
                                } else {
                                    echo "<td>No File</td>";
                                }
                                #echo "<td>" . $row['status'] . "</td> ";
                                #echo "<td><a href='view_details.php?id=" .$row['id']." '>view details</a></td>
                                echo "<td><a href='edit.php?id=" .$row['id']." '>Edit</a><td>";
                            echo "</tr>";
                            }
                    echo "</table>";
                    
                    } 

                    ?>
                </div>

            </div>
            <?php 
            
            include("user_request.php")?>
   
                
            
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    
</body>
</html>