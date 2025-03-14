<?php

session_start();

include("functions.php");
include("connection.php");

$user_data = check_login($con);

$user_id = $user_data['user_id'];

$email = $_POST['email'];
$f_name = $_POST['first_name'];
$l_name = $_POST['last_name'];
$telnumber = $_POST['telnumber'];
$address = $_POST['address'];

$sql = "UPDATE `users` SET `email` = '$email', `first_name` = '$f_name', `last_name` = '$l_name', `address` = '$address', `telnumber` = '$telnumber' WHERE `users`.`user_id` = $user_id;";

if ($con->query($sql)) {
    // Redirect to index.php after successful update
    echo "<script>alert('User details updated successfully')</script>";
    header("refresh:0.01; url=user-details.php");
} else echo "Error editing user details: " . $con->error;