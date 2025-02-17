<?php
include("includes/connection.php");

// Debugging Step: Check if db1_id exists
$sql ="select * from db2 ";

$data = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="addash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php include("admin/header.php");?>

<div class="tables">
    <div class="last-request">
        <div class="heading">
            <h2>All Requests</h2>
            <a href="#" class="btn">View All</a>
        </div>

        <?php if ($data): ?>
            <table class='Requests'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                        <th>Aadhar No</th>
                        <th>Aadhar Image</th>
                        <th>Death Person Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($data)): ?>
                        <tr>
                            <td><?php echo !empty($row['id']) ? $row['id'] : "Null"; ?></td>
                            <td><?php echo !empty($row['name']) ? $row['name'] : "Null"; ?></td>
                            <td><?php echo !empty($row['mobile_number']) ? $row['mobile_number'] : "Null"; ?></td>
                            <td><?php echo !empty($row['address']) ? $row['address'] : "Null"; ?></td>
                            <td><?php echo !empty($row['aadhar_number']) ? $row['aadhar_number'] : "Null"; ?></td>
                            <td>
                                <?php if (!empty($row['aadhar_file'])): ?>
                                    <a href='download.php?id=<?php echo htmlspecialchars($row['id']); ?>' target='_blank'>Download Aadhar</a>
                                <?php else: ?>
                                    No File
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href='admin_request.php?id=<?php echo htmlspecialchars($row['id']); ?>'>All Request</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending requests found.</p>
        <?php endif; ?>
    </div>
</div>

<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
