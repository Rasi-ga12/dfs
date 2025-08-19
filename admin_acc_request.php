<?php
// Start the session
include('includes/connection.php'); // Database connection

$status = 'Accepted'; // Define the value for binding
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);}
// Get the user ID from the session

// Check if $conn is connected
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
// Modified SQL query to fetch data from both db1 and db2
$sql = "SELECT * FROM db1 WHERE status = ? AND db1_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("si", $status, $id); // 's' for string (status), 'i' for integer (id)
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
                        <tr>
                            <td>ID</td>
                            <td>Status</td>
                            <td>Death Person Details</td>
                        </tr>
                        <?php while ($row = $data->fetch_assoc()): ?>
                            <tr>
                                <td><?= !empty($row['db1_id']) ? $row['db1_id'] : "Null"; ?></td>
                                <td><?= htmlspecialchars($row['status']); ?></td>
                                <td><a href='view_details.php?id=<?= $row['id']; ?>'>View Details</a></td>
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
