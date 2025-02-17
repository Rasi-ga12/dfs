<?php
include 'includes/connection.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if (isset($_POST['accept'])) {
        $status = "Accepted";
    } elseif (isset($_POST['reject'])) {
        $status = "Rejected";
    } elseif (isset($_POST['complete'])) {
        $status = "Completed"; // Set status to Completed when "Complete" button is clicked
    }

    $sql = "UPDATE db1 SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Status updated successfully!'); window.location.href='view_details.php?id=$id';</script>";
    } else {
        echo "<script>alert('Failed to update status.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
