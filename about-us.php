<?php

session_start();

include("functions.php");
include("connection.php");

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/about-us.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/nav.css">
    <script src="js/homepage.js"></script>
</head>
<body>
    <!-- Navbar -->
    <header>
        <a href="home.php"><img src="images/logo.png" alt="logo" id="navlogo" class="navlogo"></a>
        <nav id="navigation">
            <ul id="nav_ul">
                <li><a href="home.php"><img src="images/logo.png" alt="logo" id="navlogoalt" class="navlogoalt"></a></li>
                <li><a id="navlink" class="navlink" href="user-details.php">Hello, <?php echo $user_data['first_name'] ?></a></li>
                <li><a href="home.php" id="navlink" class="navlink">Home</a></li>
                <li><a href="book-main.php" id="navlink" class="navlink">Explore</a></li>
                <li><a href="about-us.php" id="navlink" class="navlink">About</a></li>
                <li><a href="mailto:tlcisnotarealcompany@gmail.com" id="navlink" class="navlink">Contact</a></li>
                <li><a href="cart.php" id="navlink" class="navlink">Cart</a></li>
                <li><a onclick="confirmlogout()" id="logoutbutton" class="navlink">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <!-- Navbar -->
    <h1 class="title">About Us</h1>
    <div class="main-info">
        <h3 id="h3_about">Books for All</h3>
        <p>We are an emerging international e-commerce business selling books, e-books, and audiobooks of varying genres. These genres can range from non-fiction novels to books about business and economics. The purpose of this website is to allow many users and customers from all over the world to access our catalogue and to spread recognition of the variety of books from different regions.</p>
        <br>
        <p>We may occasionally offer books that come from self-publishers in hopes of promoting their work, allowing them to gain the recognition they deserve.</p>
    </div>
    <br>
    <div class="team-info">
        <h3 id="h3_about">Meet our Team</h3>
        <div class="container">
            <div class="image">
                <img src="images/gl.png" alt="" width="256px"id="imgself">
            </div>
            <div class="text">
                <h3 id="h3_about">Ethan Liam Poon Yi</h3>
                <h4>Group Leader</h4>
                <p>Responsible for delegation and assistance of tasks between group members; design and development of website header and footer, landing page and full-stack development of cart system.</p>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="image">
                <img src="images/gm2.png" alt="" width="256px" id="imgself">
            </div>
            <div class="text">
                <h3 id="h3_about">See Thoo Jun Lok</h3>
                <h4>Group Member</h4>
                <p>Design and development of login and register page, full stack development of admin database access and front-end design of about us page.</p>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="image">
                <img src="images/gm3.jpg" alt="" width="256px" id="imgself">
            </div>
            <div class="text">
                <h3 id="h3_about">Chow Soon Weng</h3>
                <h4>Group Member</h4>
                <p>Responsible for the full stack development of the checkout system for the e-commerce website and system.</p>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="image">
                <img src="images/gm4.png" alt="" width="256px" id="imgself">
            </div>
            <div class="text">
                <h3 id="h3_about">Venessa Lee Chia Yee</h3>
                <h4>Group Member</h4>
                <p>Responsible for the creation of the entire catalogue and listing of individual books per page for the e-commerce website and system.</p>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="image">
                <img src="images/gm5.png" alt="" width="256px" id="imgself">
            </div>
            <div class="text">
                <h3 id="h3_about">Lee Kah Hin</h3>
                <h4>Group Member</h4>
                <p>Responsible for the front-end development (HTML and CSS) for cart system of the e-commerce website and system.</p>
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <footer id="bottomfooter">
        <div class="con">
            <div class="footimg"><img src="images/logo.png" alt="logo" id="footlogo"></div>
            <div class="navigation">
                <h3 id="footertitle">Navigate</h3>
                <ul id="footerlist">
                    <li><a href="home.php" id="footlink">Home</a></li>
                    <li><a href="book-main.php" id="footlink">Explore</a></li>
                    <li><a href="about-us.php" id="footlink">About</a></li>
                    <li><a href="mailto:tlcisnotarealcompany@gmail.com" id="footlink">Contact</a></li>
                </ul>
            </div>
            <div class="socials">
                <h3 id="footertitle">Socials</h3>
                <ul id="footerlist">
                    <li><a href="https://twitter.com/EthanLPY" id="footlink">Tweeter</a></li>
                    <li><a href="https://www.instagram.com/deezombiedude/" id="footlink">Imbagram</a></li>
                    <li><a href="https://www.facebook.com/zuck/" id="footlink">Acebook</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- FOOTER -->
</body>
</html>