<?php
include 'includes/connection.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $query = "SELECT aadhar_file FROM db2 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($aadhar_file);
    $stmt->fetch();
    
    if ($aadhar_file) {
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=aadhar_" . $id . ".jpg");
        echo $aadhar_file;
    } else {
        echo "File not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
