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

        <div class="container">
            <div class="sidebar">
                <ul>
                    <li>
                        <a href=""><ion-icon name="grid"></ion-icon>Dashboard</a>
                    </li>
                    <li>
                        <a href="admin.php"><ion-icon name="create"></ion-icon>Registration</a>
                    </li>
                    <li>
                        <a href="new_req.php"><ion-icon name="close-circle-sharp"></ion-icon>New Requests</a>
                    </li>
                    <li>
                        <a href="accept.php"><ion-icon name="create"></ion-icon>Accepted Requests</a>
                    </li>
                    <li>
                        <a href="complete.php"><ion-icon name="settings"></ion-icon>Completed Request</a>
                    </li>
                    <li>
                        <a href="ad_member.php"><ion-icon name="alert-circle"></ion-icon>view members</a>
                    </li>
                    <li>
                        <a href="mem_reject.php"><ion-icon name="close-circle-sharp"></ion-icon>Rejected Members</a>
                    </li>
                    <li>
                        <a href="mem_accept.php"><ion-icon name="create"></ion-icon>Accepted Members</a>
                    </li>
                    <li>
                        <a href="help.php"><ion-icon name="help-circle"></ion-icon>Help & Support</a>
                    </li>
                    <li>
                        <a href="add_member.php"><ion-icon name="alert-circle"></ion-icon>Add members</a>
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="top-bar">
                    <div class="search">
                        <input type="text" name="search" placeholder="Search here">
                        <label for="search" > <i class="fa fa-search"></i></label>
                    </div> 
                    <i class="fa fa-bell"></i>
                    <div class="user">
                    <img src="profileimg.png" alt="">
                    </div>
                </div>
           
            <div class="cards">
                <div class="card">
                    <div class="card-content">
                    <div class="number">
        <?php
        include("includes/connection.php");
        $sql = "SELECT COUNT(*) AS count FROM db1 WHERE status = 'Pending'";
        $result = mysqli_query($conn, $sql); // Execute query

        if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['count']; // Display the count
        }
        ?>
        </div>
            <div class="card-name">Pending Request</div>

                    </div>
                    <div class="icon-box">
                    <i class="fa-regular fa-pen-to-square"></i>
                        
                    </div>
                   
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number">
                        <?php
                            include("includes/connection.php");
                            $sql = "SELECT COUNT(*) AS count FROM db1 WHERE status = 'Accepted'";
                            $result = mysqli_query($conn, $sql); // Execute query

                            if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count']; // Display the count
                            }
                            ?>
                        </div>
                        <div class="card-name">Accepted Request</div>
                    </div>
                    <div class="icon-box">
                    <i class="fa-duotone fa-solid fa-circle-check"></i>
                   
                    </div>
                   
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number">
                        <?php
                            include("includes/connection.php");
                            $sql = "SELECT COUNT(*) AS count FROM member WHERE status = 'Accepted'";
                            $result = mysqli_query($conn, $sql); // Execute query

                            if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count']; // Display the count
                            }
                            ?>
                        </div>
                        <div class="card-name">Total Members</div>
                    </div>
                    <div class="icon-box">
                    <i class="fa-solid fa-person-circle-question"></i>
                    
                    </div>
                   
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number">
                        <?php
                            include("includes/connection.php");
                            $sql = "SELECT COUNT(*) AS count FROM db1 WHERE status = 'Completed'";
                            $result = mysqli_query($conn, $sql); // Execute query

                            if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count']; // Display the count
                            }
                            ?>
                        </div>
                        <div class="card-name">Completed Request</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-bed"></i>
                    </div>
                   
                </div>



            </div>