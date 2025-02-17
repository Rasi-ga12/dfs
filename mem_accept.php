<?php
include("includes/connection.php");
$sql="select * from member where status='Accepted' ";
$data=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <link rel="stylesheet" href="addash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
        <?php include("admin/header.php");?>
            <div class="tables">
                <div class="last-request">
                    <div class="heading">
                        <h2>Accepted Members</h2>
                        <a href="#" class="btn">View All</a>
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
                            <td> Action</td>
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
                                echo "<td>" . $row['status'] . "</td> ";
                                echo "<td><form action='update_status_mem.php' method='POST'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <button type='submit' name='reject' class='btn btn-reject'>Reject</button>
                                </form></td>";
                            echo "</tr>";
                            }
                    echo "</table>";
                } 
                ?>
                </div>
            </div>
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    
</body>
</html>