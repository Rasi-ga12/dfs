<?php
include 'includes/connection.php'; // Include database connection

// Check if ID is provided in URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch current data from database
    $sql = "SELECT * FROM db1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "<script>alert('Record not found!'); window.location='dashboard.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid ID!'); window.location='dashboard.php';</script>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $dateofbirth = $_POST['dateofbirth'];
    $deathdate = $_POST['deathdate'];
    $cause = $_POST['cause'];
    $address = $_POST['address'];
    $layingmethod = $_POST['layingmethod'];
    $burialtime = $_POST['burialtime'];
    $anyrequest = $_POST['anyrequest'];
    $aadhar = $_POST['aadhar'];
    $relation = isset($_POST["relation"]) ? trim($_POST["relation"]) : null;
    $relative = isset($_POST["relations"]) ? trim($_POST["relations"]) : null;
    $updateSql = "UPDATE db1 SET username=?, dateofbirth=?, deathdate=?, cause=?, address=?, layingmethod=?, burialtime=?, anyrequest=?, aadhar=? WHERE db1_id=?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sssssssssi", $username, $dateofbirth, $deathdate, $cause, $address, $layingmethod, $burialtime, $anyrequest, $aadhar,  $id);
    
    if ($updateStmt->execute()) {
        echo "<script>alert('Details updated successfully!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating details!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Death Person Details</title>
    
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background: url('https://cdn.wallpapersafari.com/26/4/MWqQB8.jpg') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}


.edit-container{
            background: transparent;
            border:2px solid rgba(255, 255, 255, .5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow:0 0 30px rgba(0, 0, 0, .5);
            background:transparent;
            display: flex;
            flex-direction: column;
            height: 850px;
            width:600px;
            border:1px solid green;
            margin:auto;
            border-radius: 25px;
            align-items:center;
}
        
    /*position:relative;
    width:600px;
    height:800px;
    background: transparent;
    border:2px solid rgba(192, 185, 185, 0.5);
    border-radius: 30px;
    backdrop-filter: blur(20px);
    box-shadow:0 0 30px rgba(0, 0, 0, .5);
    align-items: center;  


}*/

.container {
    background: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    width: 90%;
    max-width: 500px;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    color: #444;
    margin-bottom: 5px;
}

input[type="text"],
input[type="date"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: 0.3s ease-in-out;
}

input:focus,
textarea:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    outline: none;
}

.btn-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

button {
    margin-top:20px;
    padding: 10px 15px;
    color:white;
    background-color:black;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-save {
    background: #28a745;
    color: white;
}

.btn-save:hover {
    background: #218838;
}

.btn-cancel {
    background: #dc3545;
    color: white;
}

.btn-cancel:hover {
    background: #c82333;
}

    </style>
</head>
<body>
    <div class="edit-container">
        <h2>Edit Death Person Details</h2>
        <form method="POST" >
            <label>Name:</label>
            <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
            
            <label>D.O.B:</label>
            <input type="date" name="dateofbirth" value="<?php echo $row['dateofbirth']; ?>" required>
            
            <label>D.O.D:</label>
            <input type="date" name="deathdate" value="<?php echo $row['deathdate']; ?>" required>
            
            <label>Cause:</label>
            <input type="text" name="cause" value="<?php echo $row['cause']; ?>">
            
            <label>Address:</label>
            <textarea name="address" required><?php echo $row['address']; ?></textarea>
            
            <label>Laying Method:</label>
            <input type="text" name="layingmethod" value="<?php echo $row['layingmethod']; ?>">
            
            <label>Funeral Time:</label>
            <input type="time" name="burialtime" value="<?php echo $row['burialtime']; ?>">
            
            <label>Any Request:</label>
            <textarea name="anyrequest"><?php echo $row['anyrequest']; ?></textarea>
            
            <label>Aadhar:</label>
            <input type="text" name="aadhar" value="<?php echo $row['aadhar']; ?>">

            <label>Relation:</label>
            <input type="text" name="relation" value="<?php echo $row['relation']; ?>">

            <label>Relative_description:</label>
            <input type="text" name="relations" value="<?php echo $row['relative_description']; ?>">

            <button type="submit">Update Details</button>
            <a href="dashboard.php" class="btn">Cancel</a>
        </form>
    </div>
</body>
</html>
