<?php
    require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users Record | Admin Database</title>
        <link rel="stylesheet" href="css/admin_nav.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <header>
            <a href="adminpage.php"><img src="images/logo.png" alt="logo" id="navlogo" class="navlogo"></a>
            <nav id="navigation">
                <ul id="nav_ul">
                    <li><a href="adminpage.php"><img src="images/logo.png" alt="logo" id="navlogoalt" class="navlogoalt"></a></li>
                    <li><a href="adminpage.php" id="navlink" class="navlink">Main Menu</a></li>
                    <li><a href="view-books.php" id="navlink" class="navlink">Product Listing</a></li>
                    <li><a href="view-users.php" id="navlink" class="navlink">User Database</a></li>
                    <li><a href="view-transactions.php" id="navlink" class="navlink">Transaction Database</a></li>
                    <li><a href="login.php" id="navlink" class="navlink">Go to User Login</a></li>
                </ul>
            </nav>
        </header>
        <h1>List of Records</h1>

        <div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Contact</th>
                </tr>
                <?php
                $sql = "SELECT * FROM `users`;";

                $sql_run = $con->query($sql);

                if($sql_run) {  // if it is not false, then proceed
                    if($sql_run->num_rows > 0) {    // num_rows will check if there are row(s) of results
                        while($row = $sql_run->fetch_assoc()) {
                            ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['user_id']; ?></td>
                    <td><?= $row['first_name'] . ' ' . $row['last_name']; ?></td>
                    <td><?= $row['address']; ?></td>
                    <td><?= $row['telnumber']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td>
                        <a href="mailto: <?= $row['email']; ?>">Email</a>
                    </td>
                </tr>
                <?php
                        }
                    } else {
                        // echo "No table rows found.";
                        ?>
                <tr>
                    <td colspan="5">No records found.</td>
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                    <td colspan="5">Error retrieving table rows: <?= $con->error; ?></td>
                </tr>
                <?php
                }
            ?>
            </table>
        </div>

        <script src="main.js"></script>
    </body>

</html>
