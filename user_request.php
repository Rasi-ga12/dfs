<?php
// Start the session
include('includes/connection.php'); // Database connection

// Check if the user is logged in
if (!isset($_SESSION['pgasoid'])) {
    header("location: login1.php"); // Redirect to login if not logged in
    exit();
}

// Get the user ID from the session
$id = intval($_SESSION['pgasoid']);

// Check if $conn is connected
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch user requests
$sql = "SELECT * FROM db1 WHERE db1_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <link rel="stylesheet" href="addash.css">
    <style>
        .last-request {
            min-height: 100px;
            color:black;
            background: rgb(231, 252, 231);
            padding: 30px;
            box-shadow: 0 6px 8px 0 rgba(0,0,0,0.2);
        }
        .Requests{
            color:black;

        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="tables">
        <div class="last-request">
            <div class="heading">
                <h2>All Requests</h2>
            </div>

            <?php if ($data->num_rows > 0): ?>
                <table class='Requests'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Death Person Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $data->fetch_assoc()): ?>
                            <tr>
                                <td><?= !empty($row['db1_id']) ? $row['db1_id'] : "Null"; ?></td>
                                <td><?= htmlspecialchars($row['status']); ?></td>
                                <td><a href='dash_details.php?id=<?= $row['id']; ?>'>View Details</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No records found.</p>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>
