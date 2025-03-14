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
    <title>Checkout</title>
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/nav.css">
    <script src="js/homepage.js"></script>
</head>
<body>
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
    <main>
        <form action="" method="post">
            <div class="checkout_top">
                <div class="details">
                    <h1>CHECKOUT</h1>
                    <br>
                    <p class="details_title">Personal Details</p>
                    <br>
                    <hr class="details_line">

                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "ecommerce");

                    if (!$conn) {
                        die("Connection Failed: ". mysqli_connect_error());
                    }

                    $sql = "SELECT `user_id`, `first_name`, `last_name`, `address` from users where `user_id` = ". $user_data['user_id'] . "";

                    $user_data = $conn -> query($sql);
                    $row = $user_data -> fetch_assoc();
                    $user_id = $row['user_id'];

                    ?>

                    <p>Name: <input name="name" readonly type="text" class="name" value="<?php echo $row['first_name']." ".$row['last_name'];?>"></p>
                    <p>Address: <input name="address" readonly type="text" class="address" value="<?php echo $row['address'];?>"></p>

                    <?php
                    mysqli_close($conn);
                    ?>

                    <p>Card Number: <input name="cardnumber" type="number" class="cardnumber" required></p>

                </div>

                <?php $total = 0.00; ?>
            </div>
            <br>
            <br>
            <div class="checkout_middle">
                <table class="checkout_table">
                    <tr>
                        <th class="checkout_th">ISBN</th>
                        <th class="checkout_th">Book Name</th>
                        <th class="checkout_th">Quantity</th>
                        <th class="checkout_th">Price</th>
                    </tr>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "ecommerce");

                    if (!$conn) {
                        die("Connection failed; ".mysqli_connect_error());
                    }

                    $sql = "SELECT isbn, bookname, quantity, price from cart";
                    $cart = $conn->query($sql);

                    if ($cart-> num_rows > 0) {
                        $incre = 0;
                        while ($row = $cart -> fetch_assoc()) {
                            $incre = $incre + 1;
                            echo "<tr><td><input readonly name='cart_isbn$incre' id='cart_isbn' value='".$row["isbn"]."'>"."</td>
                            <td>".$row["bookname"]."</td>
                            <td>".$row["quantity"]."</td>
                            <td>RM<input disabled name='cart_price$incre' class='cart_price' id='cart_price"."$incre"."' value=".$row["price"]."></td></tr>";
                            $total = $total + $row["price"];
                        }
                    }
                    else {
                        echo "<tr><td colspan='4'><p id='nothingcart'>Nothing in Cart</p></td></tr>";
                    }

                    $shipping_fee = 5;

                    mysqli_close($conn);

                    $total1 = number_format((float)$total,2);
                    $grandtotal1 = number_format((float)$total + $shipping_fee,2);
                    ?>
                    <tr>
                        <td colspan="3" class="itemtotal">Item Total: </td>
                        <td class="total_calculation_value"><div class="total_calc_div">RM<input type="number" class="checkout_price" value="<?php echo $total1; ?>" readonly></div></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="shippingfee">Shipping Fee: </td>
                        <td class="total_calculation_value"><div class="total_calc_div">RM<input type="number" class="checkout_price" value="<?php echo number_format((float)$shipping_fee,2); ?>" readonly></div></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="grandtotal">Grand Total: </td>
                        <td class="total_calculation_value"><div class="total_calc_div">RM<input type="number" class="checkout_price" value="<?php echo $grandtotal1;?>" readonly></div></td> 
                    </tr>
                </table>
            </div>
            <?php

            if (isset($_POST["confirm"])) {

                $conn = mysqli_connect("localhost", "root", "", "ecommerce");

                if (!$conn) {
                    die("Connection failed; ".mysqli_connect_error());
                }

                
                $book_name = "";
                $book_quantity = "";
                $order_details = "";
                $transaction_id = random_num(8);
                
                $cart = $conn->query($sql);
                if ($cart-> num_rows > 0) {
                    while ($roe = $cart -> fetch_assoc()) {
                        $book_isbn = $roe["isbn"];
                        $price = $roe["price"];
                        $order_details = $roe["bookname"] . " x " . $roe["quantity"];
                        $subtract_purchase = $roe["quantity"];

                        $sql1 = "INSERT INTO transactions (`transaction_id`,`name`, order_details, total) VALUES ('$transaction_id', '$user_id', '$order_details', '$price')";
                        $conn-> query($sql1);
                        
                        $sql2 = "SELECT * FROM books WHERE isbn = $book_isbn";
                        $stock = $conn-> query($sql2);
                        $stonk = $stock -> fetch_assoc();

                        $stonk1 = $stonk['quantity'];

                        $updated_stock = (int)$stonk1 - (int)$subtract_purchase;

                        $sql3 = "UPDATE `books` SET `quantity` = '$updated_stock' where `books`.`isbn` = $book_isbn;";
                        $conn -> query($sql3);
                    }
                }
                $sql = "DELETE FROM cart";
                $conn-> query($sql);
                
                mysqli_close($conn);
            }
            ?>
            <?php
                if (isset($_POST["confirm"])) {
                    header('Location: thank-you.php');
                }
            ?>
            <div class="checkout_button"><a href="thank-you.php"><input type="submit" name="confirm" value="Confirm Purchase"></a><div>
            <br>
            <br>
        </form>
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
    <script src="js/cart.js"></script>
</body>
</html>