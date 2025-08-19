<?php
include('includes/connection.php');

if (!isset($_SESSION['pgasoid'])) {
    header("Location: login1.php");
    exit();
}

$id = intval($_SESSION['pgasoid']);
$email = $_SESSION['email'];

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$stmt = $conn->prepare("SELECT db1.* FROM db1 
                        JOIN db2 ON db1.db1_id = db2.id 
                        WHERE db2.email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$data = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .tables {
            padding: 20px;
        }

        .last-request {
            background-color: #e7fce7;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            color: #333;
            font-size: 22px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 300px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            white-space: nowrap;
            color: #000;
        }

        th {
            background-color: #d0f0c0;
            font-weight: bold;
        }

        a {
            color: #0066cc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }

            h2 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<div class="tables">
    <div class="last-request">
        <h2>All Requests</h2>

        <?php if ($data->num_rows > 0): ?>
        <div class="table-responsive">
            <table>
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
        </div>
        <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
