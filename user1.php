<?php
include('includes/connection.php');

// Check if `db2_id` is received via GET
if (isset($_GET['db2_id']) && !empty($_GET['db2_id'])) {
    $db2_id = intval($_GET['db2_id']);
} else {
    header('location:login.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = trim($_POST["person"]);
    $dateofbirth = trim($_POST["dateofbirth"]);
    $deathdate = trim($_POST["deathdate"]);
    $cause = trim($_POST["cause"]);
    $address = trim($_POST["address"]);
    $layingmethod = trim($_POST["laying"]);
    $burialtime = trim($_POST["burialtime"]);
    $anyrequest = trim($_POST["anyrequest"]);
    $aadhar = trim($_POST["aadhar"]);
    
    // Handling relation fields
    $relation = isset($_POST["relation"]) ? trim($_POST["relation"]) : null;
    $relative = isset($_POST["relations"]) ? trim($_POST["relations"]) : null;
    
    if ($relation !== "relative") {
        $relative = null; // Only store if the relation is "relative"
    }

    // File handling
    $allowedExtensions = ["png", "jpg", "jpeg", "pdf"];
    $filecontent = null;

    if (isset($_FILES["document"]) && $_FILES["document"]["error"] == UPLOAD_ERR_OK) {
        $filename = $_FILES["document"]["name"];
        $filetmpname = $_FILES["document"]["tmp_name"];
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedExtensions)) {
            die("Invalid file format. Allowed formats: png, jpg, jpeg, pdf.");
        }

        $filecontent = file_get_contents($filetmpname);
    } else {
        die("A valid file must be uploaded.");
    }

    // Insert into db1
    $stmt = $conn->prepare("INSERT INTO db1(username, dateofbirth, deathdate, cause, address, layingmethod, burialtime, anyrequest, aadhar, files, db1_id, relation, relative_description) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssiss", $name, $dateofbirth, $deathdate, $cause, $address, $layingmethod, $burialtime, $anyrequest, $aadhar, $filecontent, $db2_id, $relation, $relative);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        die("Failed to insert: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="user.css">
        <script>
                document.addEventListener('DOMContentLoaded',(event)=>{
                function setMindates()
                {
                var today=new Date().toISOString().split("T")[0];
                document.getElementById("deathdate").setAttribute('min',today);
                var burialtime = document.getElementById("burialtime");
                if (burialtime && burialtime.type === "datetime-local") {
                    var currentDateTime = new Date();
                     var year = currentDateTime.getFullYear();
                     var month = (currentDateTime.getMonth() + 1).toString().padStart(2, '0'); 
                     var day = currentDateTime.getDate().toString().padStart(2, '0');
                     var hours = currentDateTime.getHours().toString().padStart(2, '0');
                    var minutes = currentDateTime.getMinutes().toString().padStart(2, '0');

                    var formattedDateTime = ${year}-${month}-${day}T${hours}:${minutes};
                     burialtime.setAttribute('min', formattedDateTime);
                }

                }
                setMindates();
                });
            function validatingInput(field)
            {
                var fieldname=field.name;
                var fieldvalue=field.value;
                var err_loc=document.getElementById(fieldname+"Error");
                var isValid=true;
                switch(fieldname)
                {
                    case "person":
                        if(fieldvalue=="")
                        {
                            err_loc.textContent="name must be filled out";
                            isValid=false;
                        }
                        else{
                            err_loc.textContent="";
                        }
                        break;
                    case "dateofbirth":
                        if(fieldvalue=="")
                        {
                            err_loc.textContent="dob must be filled out";
                            isValid=false;
                        }
                        else{
                            err_loc.textContent="";
                        }
                        break;
                    case "deathdate":
                        if(fieldvalue=="")
                        {
                            err_loc.textContent="date must be filled out";
                            isValid=false;
                        }
                        else{
                            err_loc.textContent="";
                        }
                        break;
                    case "cause":
                        if(fieldvalue=="")
                        {
                            err_loc.textContent="cause must be filled out";
                            isValid=false;
                        }
                        else{
                            err_loc.textContent="";
                        }
                        break;
                    case "address":
                        if(fieldvalue=="")
                        {
                            err_loc.textContent="addres must be filled out";
                            isValid=false;
                        }
                        else{
                            err_loc.textContent="";
                        }
                        break;
                     case "laying":
                         if (!document.querySelector('input[name="laying"]:checked')) {
                            err_loc.textContent = "Please select burial or cremation";
                            isValid = false;
                            }
                        else{
                            err_loc.textContent="";
                             }                            
                            break;

                    case "burialtime":
                        if(fieldvalue=="")
                        {
                            err_loc.textContent="date must be filled out";
                            isValid=false;
                        }
                        else{
                            err_loc.textContent="";
                        }
                        break;
                    case "aadhar":
                        var aadharpat=/^[2-9]{1}[0-9]{11}$/; 
                        if(!aadharpat.test(fieldvalue) && fieldvalue!=="")
                        {
                            err_loc.textContent="aadhar must be filled out with 12 digits";
                            isValid=false;
                        }
                        else{
                            err_loc.textContent="";
                        }
                        break;
                    case "document":
                        
                     if (field.files.length === 0) {
                        err_loc.textContent = "Upload the file";
                        isValid = false;
                        }
                         else {
                        const file = field.files[0];
                        const maxFileSize = 204800;
                            if (file.size > maxFileSize)
                             {
                                 err_loc.textContent = "File size exceeds 200 KB";
                                 isValid = false;
                                field.value = ""; 
                                } 
                                else {
                                err_loc.textContent = "";
                                 }
                             }
                         break;
                }
                return isValid;
            }
            function formvalidate(event)
            {
                
                // event.preventDefault(); 
                var form=document.getElementById("myform");
                var isValid=true;
                for(let i=0;i<form.elements.length;i++)
                 {
                    var field=form.elements[i];
                    if(field.type!="submit" && field.tagName==="INPUT" && !validatingInput(field))
                    {
                        isValid=false;
                    }
                 }
                 if(isValid)
                 {
                    form.submit();
                    
                 }
                 return isValid;
            }
            
        document.addEventListener("DOMContentLoaded", function () {
            function toggleRelativeField() {
                let relationRadios = document.getElementsByName("relation");
                let relativeField = document.getElementsByName("relations")[0];

                let selectedRelation = document.querySelector('input[name="relation"]:checked');
                if (selectedRelation && selectedRelation.value === "relative") {
                    relativeField.disabled = false;
                } else {
                    relativeField.disabled = true;
                    relativeField.value = "";
                }
            }

            document.querySelectorAll('input[name="relation"]').forEach(radio => {
                radio.addEventListener("change", toggleRelativeField);
            });

            toggleRelativeField();
        });

        
        </script>
</head>
    <body>
    <center>
    <header>
        <a href="dashboard.php">Dashboard</a>
    </header>
    <div class= "wrapper">
    <form id="myform" action="user1.php?db2_id=<?php echo $db2_id; ?>" method="POST" enctype="multipart/form-data">
   <h1 class="space1">Death Person Details</h1>
    <table class="all1" cellpadding="27" cellspacing="27" align="center" >
        <tr>
            <td>
                Name:
            </td>
            <td>
                <input type="text" class="per1" placeholder="Name"  name="person" size="" oninput="return validatingInput(this)"><br/>
                <span id="personError"></span>
            </td>

        </tr>
        <tr>
            <td>
                Date of Birth:
            </td>
            <td>
            <input type="date" name="dateofbirth" oninput="return validatingInput(this)" ><br/>
            <span id="dateofbirthError"></span>
            </td>

        </tr>
        <tr>
            <td>
                Date of Death:
            </td>
            <td>
            <input type="date" name="deathdate" id="deathdate" oninput="return validatingInput(this)"><br/>
            <span id="deathdateError"></span>
            </td>

        </tr>
        <tr>
            <td>
                Cause of death:
            </td>
            <td>
                <input type="text" class="per2" placeholder="Cause" name="cause" oninput="return validatingInput(this)"><br/>
                <span id="causeError"></span>
            </td>

        </tr>
        <tr>
            <td>
                Address:
            </td>
            <td>
               <textarea name="address" oninput="return validatingInput(this)"></textarea><br/>
               <span id="addressError"></span>
            </td>
            
              
            
        </tr>
       
        <tr>
            <td>
                Prefered Method for laying the deceased:
            </td>
            <td>
                <input type="radio" name="laying" value="burial" oninput="return validatingInput(this)">Burial
                <input type="radio" name="laying" value="cremation" oninput="return validatingInput(this)">Cremation<br/>
                <span id="layingError"></span>
            </td>
        </tr>
        <tr>
            <td>
                Prefered time and Date for laying the deceased:
            </td>
            <td>
                <input type="datetime-local" class="per5" placeholder="Time"  name="burialtime" size="" id="burialtime" oninput="return validatingInput(this)"><br/>
                <span id="burialtimeError"></span>
            </td>
    
        </tr>
        <tr>
            <td>
                Special Request:
            </td>
            <td>
                <input type="text" class="per3" placeholder="(If Any)"  name="anyrequest" size="" oninput="return validatingInput(this)"><br/>
                <span id="anyrequestError"></span>
            </td>
        </tr>
       
        <tr>
            <td>
                Aadhar Number:
            </td>
            <td>
                <input type="text" class="per4" placeholder="Aadhar"  name="aadhar" size="" oninput="return validatingInput(this)"><br/>
                <span id="aadharError"></span>
            </td>
        </tr>
        
      
    <tr>
        <td>Upload Aadhar :  </td>
        <td>   
        <label for="uploadbtn">Upload File</label>
        <input type="file" id="uploadbtn" name="document" accept=".png,.jpg,.jpeg,.pdf" size="204800" oninput="return validatingInput(this)"><br/>
        <span id="documentError"></span>
        </td>
    </tr>
    <tr>
            <td>
                Relation:
            </td>
            <td>
                <input type="radio" name="relation" value="relative" >Relative
                <input type="radio" name="relation" value="other person">Other Person
                <span id="relationError"></span>

            </td>
            <td>
            </td>
                </tr>
                <tr>
                    <td></td>
            <td>
                <input type="text" class="form3" placeholder="If Relative"  name="relations" size="">
               
            </td>
        </tr>

    <tr> 
        <td></td>

        <td><input type="submit"  class="sub1" name="submit" size=""></td>
    </tr>
    </center>
    </table>
    </form>
                </div>
</body>
</html>