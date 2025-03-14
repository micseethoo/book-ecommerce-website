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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalogue</title>
    <link rel="stylesheet" href="css/book-main.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Secular One">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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

<!----------------- title -------------->
<h1 class="booktitle">Catalogue</h1>

<?php
$sql = "SELECT * FROM books;";

$sql_run = $con->query($sql);

if($sql_run) {  // if it is not false, then proceed
    if($sql_run->num_rows > 0) {    // num_rows will check if there are row(s) of results
        $incre = 0;
        while($row = $sql_run->fetch_assoc()) {
            if (($incre % 3) == 0)  {
                echo '<div class="book">
                <div class="row-featured">';
            }
            $incre = $incre + 1;

if ($row["quantity"] <= 0) {
    $stock = "Out of Stock";
} elseif ($row["quantity"] > 0) {
    $stock = $row["quantity"];
}
?>
<div class="featured-product">
    <a id="book_a" href = "book.php?isbn=<?= $row['isbn']; ?>"><?php echo '<img id="product_image" alt="book image" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'">'; ?></a>
    <h5><a id="book_a" href = "book.php?isbn=<?= $row['isbn']; ?>"> <?= $row["bookname"]; ?> </a></h5>
    <div class="rating">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
    </div>
    <p>Stock: <?= $stock; ?></p>
    <p>RM<?= $row["price"]; ?></p>
</div> 
<?php
if (($incre % 3) == 0)  {
    echo '</div></div>';
}
?>
<?php
        }
                        }
                    } ?>
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