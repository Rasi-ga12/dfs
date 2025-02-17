<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="header.css">
    
    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,700italic,400italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css">
    
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    
    <!-- Smooth Scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>

    <script>
        $(document).ready(function () {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({ scrollTop: $(this.hash).offset().top }, 900);
            });
        });
    </script>

    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto Slab', serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        /* Welcome Section */
        
        .head1 p{
            color: black;
            font-size: 22px;
            text-align: center;
        }
        .head1 h1:hover{
            color:midnightblue;
           


        }
        .content{
            margin-left: 20px;
        }


        .pos_cen {
            max-width: 70%;
            margin: 50px auto;
            background-color: rgba(42, 92, 61, 0.47);
            padding: 60px;
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        /* Image Styling */
        .img_deg {
            width: 40%;
            border-radius: 10px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Flexbox Layout for Welcome Content */
        .content-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        /* Text Styling */
        .content-text {
            width: 55%; 
            font-size: 18px;
            color: rgba(7, 5, 5, 0.87);
            text-indent: 40px;
            text-align: justify;
        }
        .more{
            color:purple;
        }

        /* Mission Section (Without Box)*/ 
        .mission {
            max-width: 70%;
            margin: 40px auto; /* Positioned below .pos_cen and above footer */
            text-align: right;
            margin-bottom: 300px;
            margin-left: 310px;
           
          
        }

        /* Mission Header */
        .mission h1 {
            color: #2a5c3d;
           /* font-size: 28px;
            margin-bottom: 20px;*/
            font-weight: bold;
           
        }
        .mission h1:hover{
            color: crimson;
        }

        /* Mission Content Alignment*/ 
        .mission1 {
            text-align: center;
            align-items: left;
            max-width: 90%;
            margin: 0 auto;
         
        }
        .mission2 {
            text-align: center;
            align-items:center;
            max-width: 90%;
            margin: 0 auto;
        }

        .mission1 h2 {
            color:rgb(237, 247, 240);
            font-size: 22px;
            margin-top: 15px;
            margin-right: 280px;
            margin-bottom: 10px;
            width: 80%;     
        }

        .mission1 p {
            text-align: center;
            font-size: 16px;
            color: #333;
            align-items: center;
            text-align: end;
            width: 80%; 
            margin-right: 280px;
        }
        .let{
            display: flex;
            align-items:center;
           
        }
        .content{
            display: flex;
            margin: 20px;
        }
        .content h2{
            text-align: center;
            background-color:slategray;
            padding: 25px;
            border-radius: 20px;
            margin: 15px;
           

        }
        .content h4{
            font-size: 18px;
            text-align: center;
            background-color:slategray;
            padding: 10px;
            border-radius: 20px;
            margin: 10px;
            height: 70px;
            align-items: center;
            margin-top: 28px;
            margin-left: 20px;
        }
        .content h4:hover{
            color: #f8f9fa;
            background-color: seagreen;

        }
        .people{
            font-size: 23px;
            color: green;
            margin-left: 30px;
            border-radius: 30px;
            border:2px solid #2a5c3d;
            box-shadow: 2px 2px 2px 2px;
            transition: 0.5s;
            padding: 30px;

        }
        .people:hover{
            color:darkmagenta;
        }
       

        
        .let h2:hover{
            color: #f8f9fa;
            background-color: seagreen;
        }
        .imghelp_deg{
            width: 300px;
            padding: 20px;
            float:left;
            border-radius: 50px;
            border:1px solid #2a5c3d;
            box-shadow: 1px 2px 2px 2px;
            transition: 0.5s;
            cursor: pointer;
            
        }
        .descrip:hover{
            color:darkolivegreen;
            align-items: center;
        }
        /*.mis{
            align-items: right;
        }*/

        /* Smooth Scroll Button */
        #toTop {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #2a5c3d;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

</head>
<body>
    <!-- Header -->
    <?php include_once("includes/header.php"); ?>

    <!-- Banner Section -->
    <div class="banner">
        <div class="container">
            <script src="js/responsiveslides.min.js"></script>
            <script>
                $(function () {
                    $("#slider3").responsiveSlides({
                        auto: true,
                        pager: false,
                        nav: false,
                        speed: 500,
                        namespace: "callbacks"
                    });
                });
            </script>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="welcome">
        <div class="head1">
            <h1>Welcome to Thaaimady !!</h1><br><br><br>
            <p>Thaaimady is a compassionate initiative dedicated to supporting families in times of loss by ensuring the smooth and respectful completion of "Iruthi Sadangu," the traditional final rites for the departed.Our mission is to ease the emotional and logistical challenges faced by grieving families during this crucial period.By standing by families during their most vulnerable moments, we strive to uphold traditions, foster unity, and honor the memory of the departed with dignity and respect !!</p>
        </div>
        
        <div class="pos_cen">
            <div class="content-wrapper">
                <img class="img_deg" src="https://livecub.com/wp-content/uploads/2019/11/How-to-Find-a-Dead-Person.jpg" alt="Thaaimady Initiative">
                <div class="content-text">
                    <h3 class="more">Learn more..</h3>
                    <br>
                    <p>
                    Thaaimady helps families who have lost a loved one, especially during the Iruthi Sadangu ceremony in Tamil Hindu tradition. This ceremony marks the end of the mourning period, and Thaaimady provides both practical and emotional support during this difficult time. Our services include arranging for priests to conduct the rituals, providing necessary materials, and setting up the venue. We also offer grief counseling, spiritual guidance, and community support to help families cope with their loss and find comfort.<br>
                    </p><br>
                    <p>
                       With a team of dedicated professionals, we offer assistance with funeral arrangements, documentation, 
                        and other essential tasks, allowing you to focus on remembering and honoring your loved one. 
                        We are committed to easing the burden of loss, providing a shoulder to lean on, and guiding you 
                        through every step with care and respect.
                    </p>
                </div>
            </div>
        </div><br>
        <div class="let">
        <img class="imghelp_deg" src="https://www.foundationuk.org/wp-content/uploads/2015/09/help.jpg" alt="Thaaimady Initiative">
            <div class="content">
            <h2>Let's help the needy <br> hands! </h2><br><br>
            <h4 class="need">We are there,if you need<br> us..
            </h4>
            
            </div>
            <h3 class="people">Now, this service is provided only for <br>Sivagangai peoples..</h3>
        </div>
   
            <!-- Mission Section (Below .pos_cen & Above Footer, No Box) -->
        <br>
     
        <br>
       <h1 class="descrip">Description..!</h1><br><br>
       <hr><hr>
       <div class="mission2">
            <div class="mission">
            <h1>Our Mission</h1>
            <br>
            
            <div class="mission1">
                <h2>✅ Help & Support</h2>
                <p>We provide procedural guidance to ensure rituals are performed according to tradition, logistical 
                    support for arranging necessary materials, and assistance with documentation like obtaining death certificates.</p>

                <h2>✅ Helping Hand</h2>
                <p>We not only honor traditions but also uphold a sense of humanity and solidarity, making the Thaaimady 
                    Project a true beacon of compassion and cultural preservation.</p>

                <h2>✅ Preservation of Tradition</h2>
                <p>We ensure that the sacred customs of the final rites are conducted with respect and adherence to cultural practices.</p>
            </div>
            </div>
            </div>
        </div>
           <!-- Footer-->
       <?php include_once("includes/footer.php"); ?>

   
  
    <!-- Smooth Scroll Button -->
    <script>
        $(document).ready(function () {
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
    <a href="#" id="toTop"> 
        <span id="toTopHover"></span>
    </a>
</body>
</html>