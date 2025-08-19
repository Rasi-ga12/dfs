<?php
// Start the session
include('includes/connection.php'); // Database connection

// Define the statuses to fetch
$statuses = ['Pending','Completed', 'Accepted','Rejected'];

// Store the fetched data
$dataByStatus = [];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

foreach ($statuses as $status) {
    $sql = "SELECT * FROM db1 WHERE status = ? AND db1_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $dataByStatus[$status] = $stmt->get_result();
}
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
            color: black;
            background: rgb(231, 252, 231);
            padding: 30px;
            box-shadow: 0 6px 8px 0 rgba(0,0,0,0.2);
            margin-bottom: 20px;
            border-radius: 10px;
            width:100%;
        }
        .Requests {
            color: black;
            width: 100%;
            border-collapse: collapse;
        }
        .Requests td, .Requests th {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .tables {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" crossorigin="anonymous" />
</head>
<body>
    <div class="tables">
        <?php foreach ($dataByStatus as $status => $data): ?>
            <div class="last-request">
                <div class="heading">
                    <h2><?= $status; ?> Requests</h2>
                </div>
                <div>
                <?php if ($data->num_rows > 0): ?>
                    <table class="Requests">
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Death Person Details</th>
                        </tr>
                        <?php while ($row = $data->fetch_assoc()): ?>
                            <tr>
                                <td><?= !empty($row['db1_id']) ? htmlspecialchars($row['db1_id']) : "Null"; ?></td>
                                <td><?= htmlspecialchars($row['status']); ?></td>
                                <td><a href='view_details.php?id=<?= htmlspecialchars($row['id']); ?>'>View Details</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p>No data found</p>
                <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
