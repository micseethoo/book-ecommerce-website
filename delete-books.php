<?php

require "connection.php";

$isbn = $_GET["isbn"];
$sql = "DELETE FROM `books` WHERE `isbn` = " . $isbn;


if ($con->query($sql)) {
    echo "<script>alert('Book with ISBN' . $isbn . 'deleted successfully!')</script>";
    header("refresh:0.01; url=view-books.php");
} else echo "Error deleting book " . $isbn . ": " . $con->error;
