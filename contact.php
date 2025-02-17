<?php
$msg="";
session_start();
include('includes/connection.php'); 
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['msg'];
    $contact=$_POST['contact'];
    $query=mysqli_query($conn,"INSERT INTO contact(name,email,contact,message) VALUES('$name','$email','$contact','$message')");
    if ($query) {
        $msg = "Your message was successfuly sent";
    } else {
        $msg = "Something went wrong. Please try again.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="user.css">

</head>
<body>
    <section class="contact">
        <div class="content">
            <h2>Contact Us</h2><br>
            <p>We are here to support you through challenging times. Please contact us using the information below. Our compassionate team is ready to assist with any questions or needs. We are dedicated to providing the care and support you deserve !!
                
    </p>
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><ion-icon name="navigate-circle-outline"></ion-icon></div>
                    <div class="text">
                        <h3>Address:</h3>
                        <p>k.Perunkarai,<br>Melappidavoor(po),<br>Sivagangai<br>630606</p>
                    </div>
                </div> 
                <div class="box">
                    <div class="icon"><ion-icon name="call"></ion-icon></div>
                    <div class="text">
                        <h3>Phone:</h3>
                        <p>9686765606</p>
                    </div>
                </div> 
                <div class="box">
                    <div class="icon"><ion-icon name="mail-open"></ion-icon></div>
                    <div class="text">
                        <h3>Email:</h3>
                        <p>Adengappa006@gmail.com</p>
                    </div>
                </div> 
            </div>

        
            <div class="contactform">
            <form action="contact.php" method="post">
                <h2>Send Message</h>
                    <div class="inputBox">
                    <input type="text" name="name" required="required">
                    <span>Full Name</span>
                </div>
                <div class="inputBox">
                    <input type="text" name="email" required="required">
                    <span>Email</span>
                </div>
                <div class="inputBox">
                    <input type="text" name="contact" required="required">
                    <span>Contact</span>
                </div>
                <div class="inputBox">
                    <textarea name="msg" required="required"></textarea>
                    <span>Type your Message...</span>
                </div>
                <div class="Box1">
                    <input type="submit" name="submit"  value="Send">
                </div>
                <p style="font-size:25px; color:red"> 
               <?php if($msg) { echo $msg; } ?> 
            </p>
            </form>
            </div>
        </div>
      
    </section>

    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>    

</body>
</html>