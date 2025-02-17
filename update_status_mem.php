<?php
include 'includes/connection.php'; 

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Determine the new status
    if (isset($_POST['accept'])) {
        $new_status = 'Accepted';
    } elseif (isset($_POST['reject'])) {
        $new_status = 'Rejected';
    } else {
        die("Invalid request.");
    }

    // Update status in `db1`
    $sql1 = "UPDATE member SET status='$new_status' WHERE id=$id";
    


    if (mysqli_query($conn, $sql1)) {
        echo "Status updated successfully!";
        header("Location: ad_member.php"); // Redirect back to admin panel
        exit();
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
