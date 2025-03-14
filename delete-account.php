<?php

require "connection.php";

$uid = $_GET["user_id"];
$sql = "DELETE FROM `users` WHERE `user_id` = " . $uid;

// echo $sql;

// Run the SQL statement
if ($con->query($sql)) {
    echo "<script>alert('Account deleted.')</script>";
    // Redirect to index.php after successful update
    header("refresh:0.01; url=login.php");
} else echo "Error deleting account: " . $conn->error;