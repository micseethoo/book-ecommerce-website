<?php

session_start();

include("functions.php");
include("connection.php");

$user_data = check_login($con);

    if(isset($_GET['isbn'])) {
        require "connection.php";

        $query = "SELECT * FROM books WHERE isbn = ". $_GET['isbn'] . ";";

        $result = mysqli_query($con,$query);
    }

    if ($result) {
        if ($result->num_rows > 0) {
            $book = $result->fetch_assoc();

            $book_isbn = $book["isbn"];
            $book_price = $book["price"];
            $book_name = $book["bookname"];
            $book_left = $book["quantity"];
            $image = $book["image"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $book["bookname"]; ?></title>
    <link rel="stylesheet" href="css/book.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
       
    <!-- Product details -->
    <main>
        <div class="book">
            <div class="row">
                <div class="product">
                    <?php echo '<img id="product_image" alt="Life of Pi" src="data:image/jpeg;base64,'.base64_encode( $book['image'] ).'">'; ?>
                    <div class="img-row">
                    </div>
                </div>
        
                <div class="product">
                    <p>Home / Book / <?php echo $book["category"]; ?> </p>
                    <h1><?php echo $book["bookname"]; ?></h1>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                    <h4><?php echo $book["price"]; ?></h4>
                    
                    <form method="post" action="">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "ecommerce"); 

                        if (!$conn) {
                            die("Connection failed");
                        }

                        $sql = "SELECT quantity FROM books WHERE isbn = $book_isbn";
                        $quantity = $conn->query($sql);
                        $stock = $quantity -> fetch_assoc();
                        $stock_shown = $stock['quantity'];
                        if ($stock_shown <= 0) {
                            $stock_shown = "Out of Stock";
                            $disabled = "disabled";
                            $button_value = "Out of Stock";
                            $btn_ofs = 'style="background-color: #D8D7D5; color: black;"';
                        } else {
                            $disabled = "";
                            $button_value = "Add to Cart";
                            $btn_ofs = "";
                        }
                        ?>
                        <div id="stock_p">Stock: <input type="text" class="stock" value="<?php echo $stock_shown; ?>" readonly></div>
                        <input type="number" name="quantity_b1" id="quantity_b1" min="1" value="1" <?php echo $disabled; ?>>
                        <input type="submit" value="<?php echo $button_value; ?>" id="atcb1" name="atcb1" <?php echo $btn_ofs; ?> <?php echo $disabled; ?>>
                        <?php
                        mysqli_close($conn);
                        ?>
                    </form>
                        <?php
                            if (isset($_POST["atcb1"])) {

                                $quantity_b1 = $_POST["quantity_b1"];

                                $price = $quantity_b1 * $book_price;
                            
                                $conn = mysqli_connect("localhost", "root", "", "ecommerce"); 

                                if (!$conn) {
                                    die("Connection failed");
                                }

                                if ($quantity_b1 >= 1 and $quantity_b1 <= $book_left) {
                                    $sql = "INSERT INTO cart (isbn, bookname, quantity, price)
                                            VALUES ($book_isbn, '$book_name', $quantity_b1, $price)
                                            ON DUPLICATE KEY UPDATE quantity = $quantity_b1, price = $price";
                                    echo "<script>alert('Updated ' + '$book_name' + ' in cart to ' + $quantity_b1)</script>";
                                } elseif ($quantity_b1 > $book_left) {
                                    echo "<script>alert('Error: Added more than stock (Try Again)')</script>";
                                }

                                if ($conn -> query($sql) === TRUE) {
                                } else {
                                }

                                mysqli_close($conn);
                            }
                        ?>
                    <h3>BOOK DETAILS </h3>
                    <br>
                    <p><?php echo $book['description']; ?></p>
                </div>
            </div>
        </div>
        
        <!-- Related book details -->
        <div class="border">
           <div class="row-2">
               <h2>Suggested Books</h2>
           </div>  
        </div>
        <?php
            $sql = "SELECT * FROM books;";

            $sql_run = $con->query($sql);

            if($sql_run) {  // if it is not false, then proceed
                if($sql_run->num_rows > 0) {    // num_rows will check if there are row(s) of results
                    $incre = 0;
                    while($row = $sql_run->fetch_assoc() and $incre < 3) {
                        if (($incre % 3) == 0)  {
                            echo '<div class="border">
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
    <?php
            } else echo "No data found.";               // $result->num_rows = 0 (no rows of results are retrieved)
        } else echo "Error retrieving results: " . $conn->error; // database selection query not successful
        ?>
</body>
</html>

