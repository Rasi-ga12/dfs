<?php
session_start();
error_reporting(0);
include('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="addash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <?php include("admin/header.php"); ?>
    <div class="tables">
        <div class="last-request">
            <div class="heading">
                <h2>All Requests</h2>
            </div>
            <table class="Requests">
                <thead>
                    <tr>
                        <td>SNo</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Contact</td>
                        <td>Date</td>
                        <td>Message</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ret = mysqli_query($conn, "SELECT * FROM contact WHERE isread = 0");
                    if (!$ret) {
                        die("Query failed: " . mysqli_error($conn));
                    }
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($ret)) {
                    ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>"><i class="far fa-edit"></i></a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php 
                        $cnt++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>