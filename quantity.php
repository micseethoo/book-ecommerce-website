<?php
include ("connection.php");

$conn = mysqli_connect("localhost", "root", "", "ecommerce");

if (!$conn) {
    die("Connection failed; ".mysqli_connect_error());
}

$sql = "SELECT isbn, bookname, quantity, price from cart";
$cart = $conn->query($sql);

$row = $cart -> fetch_assoc();

if ($cart-> num_rows > 0) {
    $sql2 = "SELECT price, quantity from books WHERE isbn = ".$row["isbn"].";";
    $book_data = $conn->query($sql2);
    $incre = 0;
    while ( $row and $books = $book_data -> fetch_assoc()) {

        $incre = $incre + 1;

        $cart_isbn = $row["isbn"];
                    
        $cart_quantity = $row["quantity"];

        $book_price = $books["price"];

        $book_stock = $books["quantity"];

        if (isset($_POST["cart_subtract$incre"])) {

            $quantity_updated = $cart_quantity - 1;

            $price_updated = $quantity_updated * $book_price;

            $conn = mysqli_connect("localhost", "root", "", "ecommerce");

            if (!$conn) {
                die("Connection failed; ".mysqli_connect_error());
            }

            if ($quantity_updated == 0) {
                $sql = "DELETE FROM cart WHERE isbn = $cart_isbn";
            } else {
                $sql = "UPDATE cart SET quantity = $quantity_updated, price = $quantity_updated * $book_price WHERE isbn = $cart_isbn";
            }

            if ($conn-> query($sql) === TRUE) {
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "some inevitable fatal error gonna happen anyways";
            }
                
            mysqli_close($conn);
        }
    // Subtract first row

    // Add first row
        if (isset($_POST["cart_add$incre"])) {

            $quantity_updated = $cart_quantity + 1;

            $price_updated = $quantity_updated * $book_price;

            $conn = mysqli_connect("localhost", "root", "", "ecommerce");

            if (!$conn) {
                die("Connection failed; ".mysqli_connect_error());
            }

            if ($quantity_updated > $book_stock) {
                echo "<script>alert('Error: Added More Than Stock (Try Again)')</script>";
            } else {
                $sql = "UPDATE cart SET quantity = $quantity_updated, price = $quantity_updated * $book_price WHERE isbn = $cart_isbn";
            }
            
            if ($conn-> query($sql) === TRUE) {
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
            }
                
            mysqli_close($conn);


        }
        // Add first row

        // Remove first row
        if (isset($_POST["cart_remove$incre"])) {;

            $conn = mysqli_connect("localhost", "root", "", "ecommerce");

            if (!$conn) {
                die("Connection failed; ".mysqli_connect_error());
            }

            $sql = "DELETE FROM cart WHERE isbn = $cart_isbn";

            if ($conn-> query($sql) === TRUE) {
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "some inevitable fatal error gonna happen anyways";
            }
                
            mysqli_close($conn);
        }
        // Remove first row
    }
}
?>
