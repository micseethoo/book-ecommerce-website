<?php
    require "connection.php";

    $isbn = $_POST["isbn"];
    $bookname = $_POST["bookname"];
    $booktype = $_POST["booktype"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    $sql = "UPDATE `books` SET `quantity` = '$quantity', `price` = '$price' WHERE `books`.`isbn` = $isbn;";
    
    if ($con->query($sql)) {
        // Redirect to index.php after successful update
        echo "<script>alert('Updated Book with ISBN " . $isbn . " successfully')</script>";
        header("refresh:0.01; url=view-books.php");
    } else echo "Error updating book " . $isbn . ": " . $con->error;

        
?>