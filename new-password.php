<?php

session_start();

include("functions.php");
include("connection.php");

$user_data = check_login($con);

$uid = $_POST['userid'];
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];

var_dump($user_data['password']);

$realpw = $user_data['password'];
$user_id = $user_data['user_id'];

if ($realpw == $oldpassword) {
    $sql = "UPDATE `users` SET `password` = '$newpassword' WHERE `users`.`user_id` = $user_id;";

    if ($con->query($sql)) {
        echo "<script>alert('Password changed successfully.')</script>";
        header("refresh:0.01; url=user-details.php");
    } else echo "Error changing password: " . $con->error;
} else {
    echo "<script>alert('Current password incorrect.')</script>";
    header("refresh:0.01; url=user-details.php");
}