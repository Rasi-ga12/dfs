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


</head>
<body>

    <!-- Header -->
    <?php include_once("includes/header.php"); ?>

    <!-- Banner -->
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
        <div class="bullet-text">
            <h1>Welcome to Thaaimady !!</h1><br><br>
            <p>Thaaimady is a compassionate initiative committed to honoring the departed with dignity and supporting families through the traditional final rites known as Iruthi Sadangu.</p>
            <p>Our mission begins with a heartfelt focus on serving orphaned individuals, ensuring they receive the respect and cultural rituals they deserve, even in the absence of immediate family. After prioritizing these vulnerable souls, we extend our support to all grieving families, easing the emotional and logistical burdens during one of life’s most difficult moments.</p>
            <p>By standing by families in their most vulnerable times, Thaaimady strives to uphold cherished traditions, promote unity, and provide a peaceful farewell to the departed—marked by compassion, dignity, and respect.</p>
        </div>

        <div class="pos_cen">
            <div class="content-wrapper">
                <img class="img_deg" src="https://livecub.com/wp-content/uploads/2019/11/How-to-Find-a-Dead-Person.jpg" alt="Thaaimady Initiative">
                <div class="content-text">
                    <h3 class="more">Learn more..</h3>
                    <p>Thaaimady helps families who have lost a loved one, especially during the Iruthi Sadangu ceremony in Tamil Hindu tradition. This ceremony marks the end of the mourning period, and Thaaimady provides both practical and emotional support during this difficult time.</p>
                    <p>Our services include arranging for priests to conduct the rituals, providing necessary materials, and setting up the venue. We also offer grief counseling, spiritual guidance, and community support to help families cope with their loss and find comfort.</p>
                </div>
            </div>
        </div>

        <div class="let">
            <img class="imghelp_deg" src="https://www.foundationuk.org/wp-content/uploads/2015/09/help.jpg" alt="Help">
            <div class="content">
                <h2>Let's help the needy hands!</h2>
                <h4 class="need">We are there, if you need us..</h4>
            </div>
            <div class="people">
                Now, this service is provided only for <br>Sivagangai people..
            </div>
        </div>

        <h1 class="descrip">Description..!</h1>
        

        <div class="mission2">
            <div class="mission">
                <h1>Our Mission</h1>
                <div class="mission1">
                    <h2>✅ Help & Support</h2>
                    <p>We provide procedural guidance to ensure rituals are performed according to tradition, logistical support for arranging necessary materials, and assistance with documentation like obtaining death certificates.</p>

                    <h2>✅ Helping Hand</h2>
                    <p>We not only honor traditions but also uphold a sense of humanity and solidarity, making the Thaaimady Project a true beacon of compassion and cultural preservation.</p>

                    <h2>✅ Preservation of Tradition</h2>
                    <p>We ensure that the sacred customs of the final rites are conducted with respect and adherence to cultural practices.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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
