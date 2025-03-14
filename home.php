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
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <!-- NAVBAR -->
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
    <!-- NAVBAR -->

    <!-- PAGE CONTENTS -->
    <main>
        <div class="headcont">
            <div class="headtext">
                <h1 id="head1_1">PROVIDING BOOKS<br>FOR ALL READERS</h1>
                <p id="headp_1">No more going to the bookstore,<br> we've got everything for you here!</p>
                <div id="explore"><a href="book-main.php"><button id="exploreid">Explore!</button></a></div>
                <br>
            </div>
            <div class="headimage"></div>
        </div>
        <div class="featured_cont">
            <div class="featured_header">
                <div class="featured_header_text" id="featuredheader">Featured Books</div>
                <?php
                $sql = "SELECT * FROM books LIMIT 3;";

                $sql_run = $con->query($sql);

                if($sql_run) {  // if it is not false, then proceed
                    if($sql_run->num_rows > 0) {    // num_rows will check if there are row(s) of results
                        $incre = 0;
                        while($row = $sql_run->fetch_assoc()) {

                            $desc_var = $row["description"];
                            if (strlen($desc_var) <= 100) {
                                $desc = $row["description"];
                            } elseif (strlen($desc_var) >= 100) {
                                $desc = substr($desc_var,0,100) . "..."; 
                            }

                            if ($row["quantity"] <= 0) {
                                $stock = "Out of Stock";
                                $button = "Out of Stock";
                                $disable = "disabled";
                                $style = 'style="background-color: #D8D7D5; color: black;"';
                            } elseif ($row["quantity"] > 0) {
                                $stock = $row["quantity"];
                                $button = "Add to Cart";
                                $disable = "";
                                $style = "";
                            }
                ?>
            <div class="featured_list">
                <div class="featured_item">
                    <div class="featured_item1a">
                        <?php echo '<img id="book_image" alt="book image" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'">'; ?>
                    </div>
                    <div class="featured_item1b">
                        <div class="featured_item1b_header"><h3 id="booktitle"><?= $row["bookname"]; ?></h3></div>
                        <div class="featured_item1b_description"><?= $desc; ?><br>ISBN: <?= $row["isbn"]; ?><br><span id="pricetag">RM<?= $row["price"]; ?></span></div>
                        <div class="freatued_item1b_stock">Stock: <?= $stock; ?></div>
                        <form method="post" action="">
                            <input type="number" name="quantity_b<?php echo $incre; ?>" id="quantity_b1" min="1" value="1" <?php echo $disable; ?>>
                            <input type="submit" value="<?= $button; ?>" id="atcb1" name="atcb<?php echo $incre; ?>" <?php echo $style; ?> <?php echo $disable; ?>>
                        </form>
                        <?php
                            if (isset($_POST["atcb".$incre])) {

                                $quantity_input = $_POST["quantity_b".$incre];

                                $price = $quantity_input * $row["price"];

                                $book_left = $row["quantity"];

                                $book_isbn = $row["isbn"];

                                $book_name = $row["bookname"];
                            
                                $conn = mysqli_connect("localhost", "root", "", "ecommerce"); 

                                if (!$conn) {
                                    die("Connection failed");
                                }

                                if ($quantity_input >= 1 and $quantity_input <= $book_left) {
                                    $sql = "INSERT INTO cart (isbn, bookname, quantity, price)
                                            VALUES ($book_isbn, '$book_name', $quantity_input, $price)
                                            ON DUPLICATE KEY UPDATE quantity = $quantity_input, price = $price";
                                    echo "<script>alert('Updated ' + '$book_name' + ' in cart to ' + $quantity_input)</script>";
                                } elseif ($quantity_input > $book_left) {
                                    echo "<script>alert('Error: Added more than stock (Try Again)')</script>";
                                }

                                if ($conn -> query($sql) === TRUE) {
                                } else {
                                }

                                mysqli_close($conn);
                            }
                        ?>
                    </div>
                </div>
                <?php
                $incre = $incre + 1;
        }
                        }
                    } ?>
        </div>
    </main>
    <!-- PAGECONTENTS -->

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
    <script src="js/homepage.js"></script>
</body>
</html>