<?php

require "connection.php";

if(isset($_POST["submit"])){  
    $isbn = $_POST["isbn"];
    $bookname = $_POST["bookname"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    
    $filename = basename($_FILES["image"]["name"]);
    $image = $_FILES['image']['tmp_name']; 
    $imgContent = addslashes(file_get_contents($image)); 
     
    $insert = $con->query("INSERT into `books` (isbn, bookname, `description`, quantity, price, `image`, category) VALUES ('$isbn', '$bookname', '$description', '$quantity', '$price','$imgContent', '$category')"); 
         
    if($insert){ 
        echo "<script>alert('New book added successfully')</script>";
        header("refresh:0.01; url=view-books.php");
    } else{ 
        echo "<script>alert('Error adding new book')</script>";
        header("refresh:0.01; url=view-books.php");
    }
} 

?>