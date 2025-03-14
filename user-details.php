<?php

session_start();

include("functions.php");
include("connection.php");

$user_data = check_login($con);

if ($user_data['telnumber'] === "-") {
    $telnumber = "";
} else $telnumber = $user_data['telnumber'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/user-details.css">
    <link rel="stylesheet" href="css/nav.css">
    <style>
        input, label {
            display: block;
        }
    </style>
    <script>
        function confirmDelete(user_id) {
            const CONFIRM_RESULT = confirm(`Are you sure you want to delete this account? This action cannot be undone.`);
            if (CONFIRM_RESULT) window.location.href = `delete-account.php?user_id=${user_id}`;
        }
    </script>
</head>
<body>
    <!-- Navbar -->
    <header>
        <a href="home.php"><img src="images/logo.png" alt="logo" id="navlogo" class="navlogo"></a>
        <nav id="navigation">
            <ul id="nav_ul">
                <li><a href="home.php"><img src="images/logo.png" alt="logo" id="navlogoalt" class="navlogoalt"></a></li>
                <li><a id="navlink" class="navlink" href="user-details.php">Hello, <?php echo $user_data['first_name'] ?></a></li>
                <li><a href="home.php" id="navlink" class="navlink">Home</a></li>
                <li><a href="book-main.php" id="navlink" class="navlink">Explore</a></li>
                <li><a href="about-us.php" id="navlink" class="navlink">About</a></li>
                <li><a href="mailto:tlcisnotarealcompany@gmail.com" id="navlink" class="navlink">Contact</a></li>
                <li><a href="cart.php" id="navlink" class="navlink">Cart</a></li>
                <li><a onclick="confirmlogout()" id="logoutbutton" class="navlink">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <!-- Navbar -->
    <main>
    <div class="details_header"><h1>Your Details</h1></div>
    <form action="new-user-info.php" method="POST">
        <fieldset>
            <legend class="legend">Personal Info</legend>
            <label for="email">Email</label>
            <input type="text" name="email" id="personal_input" value="<?php echo $user_data['email'] ?>">
            <br>
            <!-- <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="personal_input" value="<?php echo $user_data['first_name'] ?>">
            <br>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="personal_input" value="<?php echo $user_data['last_name'] ?>">
            <br> -->
            <div class="container2">
				<div class="names1">
    	        	<label for="first_name" id="name">First Name</label>
    	        	<input type="text" name="first_name" id="personal_input" value="<?php echo $user_data['first_name'] ?>" autocomplete="off" required>
				</div>
				<div class="names2">
					<label for="last_name" id="name">Last Name</label>
    	        	<input type="text" name="last_name" id="personal_input" value="<?php echo $user_data['last_name'] ?>" autocomplete="off" required>
				</div>
			</div>
            <br>
            <label for="address">Address</label>
            <input type="text" name="address" id="personal_input" placeholder="Address" value="<?php echo $user_data['address'] ?>">
            <br>
            <label for="telnumber">Phone Number</label>
            <input type="tel" name="telnumber" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" id="personal_input" value="<?php echo $telnumber ?>">
            <a id="telformat"> Format: XXX-XXX-XXXX</a>
            <br>
            <input type="submit" value="Save Settings" id="personal_submit">
        </fieldset>
    </form>
    <form action="new-password.php" method="POST">
        <fieldset>
            <legend class="legend">Security Settings</legend>
            <label for="userid">User ID</label>
            <input type="number" name="userid" id="user_id" value="<?php echo $user_data['user_id'] ?>" readonly>
            <p>Take a screenshot/photo of this ID for emergency uses (e.g. Lost password).</p>
            <p>Do not share this User ID with anyone. This ID is crucial for password recovery/reset.</p>
            <h2>Change Password</h2>
            <label for="oldpassword">Current Password</label>
            <input type="password" name="oldpassword" id="security_input">
            <br>
            <label for="newpassword">New Password</label>
            <input type="password" name="newpassword" id="security_input">
            <br>
            <button id="security_submit">Change Password</button>
        </fieldset>
    </form>
    <form>
        <fieldset>
            <legend class="legend">Transaction History</legend>
            <label for="trans_his" id="trans_history">Transaction History (Last 10)</label>
            <table>
                <tr>
                    <th id="trans_th">ID</th>
                    <th id="trans_th">Transaction ID</th>
                    <th id="trans_th">Order Details</th>
                    <th id="trans_th">Total</th>
                </tr>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "ecommerce");

                if (!$conn) {
                    die("Connection failed; ".mysqli_connect_error());
                }

                $sql = "SELECT id, transaction_id, order_details, total FROM transactions WHERE name = ".$user_data["user_id"]." ORDER BY id DESC LIMIT 10;";
                $trans = $conn->query($sql);


                if ($trans-> num_rows > 0) {
                    while ($row = $trans -> fetch_assoc()) {
                        $total = $row["total"];
                        echo "<tr><td>".$row["id"]."</td>
                        <td>".$row["transaction_id"]."</td>
                        <td>".$row["order_details"]."</td>
                        <td>".$row["total"]."</td></tr>";
                    }
                }
                else {
                    echo "<tr><td colspan='4'><p id='nothingcart'>No transactions</p></td></tr>";
                }
                mysqli_close($conn);
                ?>
            </table>
        </fieldset>
    </form>
    <br>
    <fieldset>
        <legend class="legend">More Account Settings</legend>
        <div id="delete_div">
            <button id="delete_btn" onclick="confirmDelete(<?php echo $user_data['user_id']; ?>)">Delete Account</button>
        </div>
        <p>Account Deletion is <b>PERMANENT</b>, account recovery is not possible once this action is performed.</p>
    </fieldset>
    <br>
    </main>
    <!-- FOOTER -->
    <footer id="bottomfooter">
        <div class="con">
            <div class="footimg"><img src="images/logo.png" alt="logo" id="footlogo"></div>
            <div class="navigation">
                <h3 id="footertitle">Navigate</h3>
                <ul id="footerlist">
                    <li><a href="home.php" id="footlink">Home</a></li>
                    <li><a href="book-main.php" id="footlink">Explore</a></li>
                    <li><a href="about-us.php" id="footlink">About</a></li>
                    <li><a href="mailto:tlcisnotarealcompany@gmail.com" id="footlink">Contact</a></li>
                </ul>
            </div>
            <div class="socials">
                <h3 id="footertitle">Socials</h3>
                <ul id="footerlist">
                    <li><a href="https://twitter.com/EthanLPY" id="footlink">Tweeter</a></li>
                    <li><a href="https://www.instagram.com/deezombiedude/" id="footlink">Imbagram</a></li>
                    <li><a href="https://www.facebook.com/zuck/" id="footlink">Acebook</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- FOOTER -->
</body>
</html>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "login_sample_db");

                if (!$conn) {
                    die("Connection failed; ".mysqli_connect_error());
                }
        
                $sql = "SELECT id, transaction_id, `name`, bookname, quantity, total FROM transactions WHERE `name` = ".$user_data["user_id"].";";
                $trans = $conn->query($sql);

                
                if ($trans-> num_rows > 0) {
                    while ($row = $trans -> fetch_assoc()) {
                        $total = $row["total"];
                        echo "<tr><td>".$row["id"]."</td>
                        <td>".$row["transaction_id"]."</td>
                        <td>".$row["name"]."</td>
                        <td>".$row["bookname"]."</td>
                        <td>".$row["quantity"]."</td>
                        <td>".$row["total"]."</td></tr>";
                    }
                }
                else {
                    echo "<tr><td colspan='4'><p id='nothingcart'>Nothing in Cart</p></td></tr>";
                }
                mysqli_close($conn);
                ?>
            </table>
        </fieldset>
    </form> -->