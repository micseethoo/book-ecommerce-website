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
    <title>Cart</title>
    <link rel="stylesheet" href="css/cart.css">
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

    <!-- Page Contents -->
    <main>

        <h1 id="cartheader">Your Cart</h1>

        <form method="post" action="">
            <table id="carttable">
                <tr>
                    <th id="cart_th">ISBN</th>
                    <th id="cart_th">Book Name</th>
                    <th id="cart_th">Quantity</th>
                    <th id="cart_th">Price</th>
                </tr>
                <?php
            
                    $conn = mysqli_connect("localhost", "root", "", "ecommerce");

                    if (!$conn) {
                        die("Connection failed; ".mysqli_connect_error());
                    }
            
                    $sql = "SELECT isbn, bookname, quantity, price from cart";
                    $cart = $conn->query($sql);
                    
                    $total = 0.00;

                    if ($cart-> num_rows > 0) {
                        $incre = 0;
                        while ($row = $cart -> fetch_assoc()) {
                            $incre = $incre + 1;
                            echo "<tr><td><input readonly name='cart_isbn$incre' id='cart_isbn' value='".$row["isbn"]."'>"."</td>
                            <td>".$row["bookname"]."</td>
                            <td>"."<input type='submit' value='-' id='cart_subtract' name='cart_subtract$incre'>"."<input readonly id='cart_quantity' name='cart_quantity$incre' min='0' value='".$row["quantity"]."'>"."<input type='submit' value='+' id='cart_add' name='cart_add$incre'>"."<input type='submit' value='Remove' id='cart_remove' name='cart_remove$incre'>"."</td>
                            <td>RM<input disabled name='cart_price$incre' class='cart_price' id='cart_price"."$incre"."' value=".$row["price"]."></td></tr>";
                            $total = $total + $row["price"];
                        }
                    }
                    else {
                        echo "<tr><td colspan='4'><p id='nothingcart'>Nothing in Cart</p></td></tr>";
                    }
                    mysqli_close($conn);
                ?>
                <tr>
                    <th colspan="3" id="cart_total">Total Price:</th>
                    <td id="cart_price_total_td">RM<input type="number" id="cart_price_total" value="<?php echo number_format((float)$total,2); ?>"</td>
                </tr>
            </table>
        </form>
        <br>
        <div id="checkout_button"><a href="checkout.php"><input type="submit" name="proceed_to_checkout" value="Proceed to Checkout"></a><div>
    </main>
    <!-- Page Contents -->

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
    <script src="js/cart.js"></script>
</body>
</html>