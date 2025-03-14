<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($email) && !empty($password))
		{

			//read from database
			$query = "select * from users where email = '$email'";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					if($user_data['password'] === $password)
					{
						echo "<script>alert('Login successful!');</script>";
						$_SESSION['user_id'] = $user_data['user_id'];
						header("refresh:0.01; url=home.php");
						die;
					} else {
						echo "<script>alert('Wrong email or password!')</script>";
					}
				} else {
					echo "<script>alert('Wrong email or password!')</script>";
				}
			} 
		} else
		{
			echo "<script>alert('Please enter your credentials')</script>";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page | The Last Chapter</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
	<form method="post">
    	<div class = "container">
    	    <div class="text">
				<img src="images/logo.png" alt="logo" width="250px" id="logo">
    	        <h1>Login</h1>
    	        <label for="name">Email</label>
    	        <input type="text" name="email">
    	        <br>
    	        <label for="password">Password</label>
    	        <input type="password" name="password">
    	        <p id="links1">Forgot your password? <a href="forgot-password.php">Click here.</a></p>
    	        <p id="links2">Don't have an account? <a href="signup.php">Sign up here.</a></p>
    	        <input type="submit" value="Login" id="loginbutton">
				<br>
				<a href="adminpage.php" id="adminpage">Switch to Admin Page</a>
    	    </div>
    	</div>
	</form>

</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
	<form method="post">
    	<div class = "container">
    	    <div class="text">
    	        <h1>Login</h1>
    	        <label for="name">Name</label>
    	        <input type="text" name="email">
    	        <br>
    	        <label for="password">Password</label>
    	        <input type="password" name="password">
    	        <br>
    	        <a href="">Forgot your password?</a>
    	        <br>
    	        <a href="signup.php">Don't have an account? Sign up here</a>
    	        <br>
    	        <br>
    	        <input id="button" type="submit" value="Login">
    	    </div>
    	</div>
	</form>

</body>
</html> -->