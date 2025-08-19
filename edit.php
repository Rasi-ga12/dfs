<?php
session_start();
include('includes/connection.php'); // Include database connection

// Check if user is logged in
if (!isset($_SESSION['pgasoid'])) {
    header("location: login1.php");
    exit();
}

// Get user ID from URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo "Invalid request.";
    exit();
}

// Fetch user details
$sql = "SELECT * FROM db2 WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "User not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $aadhar_number = $_POST['aadhar_number'];
    
    $update_sql = "UPDATE db2 SET name='$name', mobile_number='$mobile_number',
     address='$address', aadhar_number='$aadhar_number' WHERE id=$id";
    
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Details updated successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error updating details: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Details</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: url('https://cdn.wallpapersafari.com/26/4/MWqQB8.jpg') no-repeat center center/cover;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    max-width: 600px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-top: 10px;
    color: #444;
}
.wrapper{
  
  position:relative;
  width:500px;
  height:540px;
  background: transparent;
  border:2px solid rgba(255, 255, 255, .5);
  border-radius: 20px;
  backdrop-filter: blur(20px);
  box-shadow:0 0 30px rgba(0, 0, 0, .5);
  display:flex;
  justify-content:center;
  align-items: center;    
}
input, select, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

textarea {
    resize: vertical;
}

button {
    margin-top: 20px;
    padding: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
}

button:hover {
    background: #0056b3;
}

.cancel-btn {
    background: #ccc;
}

.cancel-btn:hover {
    background: #888;
}

    </style>
</head>
<body>
   <div> <h2>Edit User Details</h2>
   <div class="wrapper">
    <form method="POST">
        <label>Mobile Number:</label>
        <input type="text" name="mobile_number" value="<?php echo $row['mobile_number']; ?>">
        
        <label>Address:</label>
        <textarea name="address"><?php echo $row['address']; ?></textarea>
        
        <label>Aadhar Number:</label>
        <input type="text" name="aadhar_number" value="<?php echo $row['aadhar_number']; ?>">
        
        <button type="submit">Update</button>
        <br><br>
        <a href="dashboard.php">Cancel</a>
    </form>
</div>
</div>
</body>
</html>
