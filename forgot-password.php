

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page | The Last Chapter</title>
    <link rel="stylesheet" href="css/reset-password.css">
</head>
<body>
	<form method="post">
    	<div class = "container">
    	    <div class="text">
				<img src="images/logo.png" alt="logo" width="250px" id="logo">
    	        <h1>Reset Password</h1>
                <p>Please enter the following details for password reset.</p>
    	        <label for="uid">User ID</label>
    	        <input type="number" name="uid">
    	        <br>
                <label for="email">Email</label>
    	        <input type="text" name="email">
                <br>
    	        <label for="password">New Password</label>
    	        <input type="password" name="password">
                <br>
                <br>
    	        <input type="submit" value="Reset Password" id="loginbutton">
				<br>
                <a href="login.php" id="back">Back to Login Screen</a>
    	    </div>
    	</div>
	</form>

</body>
</html>

<?php

session_start();

include("connection.php");


if($_SERVER['REQUEST_METHOD'] == "POST") {

    $user_id = $_POST['uid'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($user_id) && !empty($email) && !empty($password))
	{
        $query = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
            
                var_dump($user_data);
            
                if($user_data['email'] === $email) {
                    $sql = "UPDATE `users` SET `password` = '$password' WHERE `users`.`user_id` = $user_id;";
                
                    if ($con->query($sql)) {
                        echo "<script>alert('Password resetted successfully.')</script>";
                        header("refresh:0.01; url=login.php");
                    } else echo "Error changing password: " . $con->error;
                } else echo "<script>alert('Incorrect email.')</script>";
            } else echo "<script>alert('User with this ID does not exist')</script>";
        } 
    } else echo "<script>alert('Form not complete')</script>";
}

?>