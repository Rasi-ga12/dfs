<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>popup</title>
    <link rel="stylesheet" href="signup.css">

</head>
<body>

    <div class=popup id="Popup">
        <img src="tick.png">
        <h2>Thankyou</h2>
        <p>You are Successfully Registered</p>
        <button type="button" onclick="closePopup()" >OK</button>
    </div>
    
</body>
</html>
<div class=popup id="Popup">
        <img src="tick.png">
        <h2>Thankyou</h2>
        <p>You are Successfully Registered</p>
        <button type="button" onclick="closePopup()" >OK</button>
</div>
    
<script>
    let popup=document.getElementById("popup");
    function openPopup{
        popup.classList.add("open-Popup")

    }
    function openPopup{
        popup.classList.remove("open-Popup")

    }
</script>