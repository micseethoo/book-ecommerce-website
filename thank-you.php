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
    <title>Thank You</title>
    <link rel="stylesheet" href="css/thank-you.css">
    <link rel="stylesheet" href="css/nav.css">
    <script src="js/homepage.js"></script>
</head>
<body>
<!-- Navbar -->
<header>
    <a href="home.php"><img src="images/logo.png" alt="logo" id="navlogo" class="navlogo"></a>
    <nav id="navigation" class="navigation">
        <ul id="nav_ul">
                <li><a href="home.php"><img src="images/logo.png" alt="logo" id="navlogoalt" class="navlogoalt"></a></li>
                <li><a id="navlink" class="navlink" href="user-details.php">Hello, <?php echo $user_data['first_name'] ?></a></li>
                <li><a href="home.php" id="navlink" class="navlink">Home</a></li>
                <li><a href="book-main.php" id="navlink" class="navlink">Explore</a></li>
                <li><a href="#" id="navlink" class="navlink">About</a></li>
                <li><a href="mailto:tlcisnotarealcompany@gmail.com" id="navlink" class="navlink">Contact</a></li>
                <li><a href="cart.php" id="navlink" class="navlink">Cart</a></li>
                <li><a onclick="confirmlogout()" id="logoutbutton" class="navlink">Log Out</a></li>
        </ul>
    </nav>
</header>
<!-- Navbar -->

<main>
    <div class="container">
        <div class="thanks">
            <h1>Thank You for your purchase!</h1>
            <p>Thanks for supporting us!<br>Your products will arrive between 1-2 Weeks</p>
            <a href="home.php"><button>Return to Homepage</button></a>
        </div>
    </div>
</main>

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