<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register an Account | The Last Chapter</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
	<form method="post" autocomplete="off">
    	<div class = "container">
    	    <div class="text">
				<img src="images/logo.png" alt="logo" width="250px" id="logo">
				<div class="title">
					<h1>Sign Up</h1>
				</div>
				<label for="email">Email</label>
    	        <input type="email" name="email" id="email" autocomplete="off" required>
				<br>
				<div class="container2">
					<div class="names1">
    	        		<label for="first_name" id="name">First Name</label>
    	        		<input type="text" name="first_name" id="first_name" autocomplete="off" required>
					</div>
					<div class="names2">
						<label for="last_name" id="name">Last Name</label>
    	        		<input type="text" name="last_name" id="last_name" autocomplete="off" required>
					</div>
				</div>
    	        <br>
				<label for="address">Address</label>
    	        <input type="text" name="address" autocomplete="off" required>
				<br>
    	        <label for="telnumber" id="telnumberlabel">Phone Number (Optional)</label>
    	        <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="telnumber" autocomplete="off">
				<a id="telformat"> Format: XXX-XXX-XXXX</a>
				<br>
				<br>
    	        <label for="password">Password</label>
    	        <input type="password" name="password" id="password" autocomplete="off" required>
				<a onclick="seepassword();" id="revealpw">Show password</a>
    	        <br>
    	        <br>
    	        <br>
				<p>Already have an account? <a href="login.php">Click here to login.</a></p>
    	        <input id="signupbutton" type="submit" value="Create Account" name="signup">
    	    </div>
    	</div>
	</form>
	<script src="js/signup.js"></script>
</body>
</html>

<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'cart');
	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		// $user_name = $_POST['user_name'];
		$address = $_POST['address'];
		$password = $_POST['password'];
		$telnumber = $_POST['telnumber'];

		$sqli_email = "SELECT * FROM users WHERE email='$email'";
  		$res_email = mysqli_query($db, $sqli_email);


		if (mysqli_num_rows($res_email) > 0) {
			echo "<script>let x = confirm('This email exists, would you like to sign in instead?');
							if (x) {
								window.location = 'login.php'
							}
			</script>";
		} else {
			if (empty($telnumber)) {
				$telnumber = "-";
			}

			//save to database
			$user_id = random_num(8);
			$query = "insert into users (email,user_id,first_name,last_name,address,telnumber,password) values ('$email','$user_id','$first_name','$last_name','$address','$telnumber','$password')";

			mysqli_query($con, $query);

			echo "<script>alert('Account Created Successfully');</script>";

			header("refresh:0.01; url=login.php");
			die;
		} 
		// else {
		// 	echo "<script>alert('Username cannot only contain numeric characters');</script>";
		// }
	}
?>