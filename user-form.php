<?php
    if(isset($_GET['user_id'])) {
        require "connection.php";

        $query = "SELECT * FROM `users` WHERE `user_id` = ". $_GET['user_id'] . ";";

        $result = mysqli_query($con,$query);

        if($result) {
            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
            } else echo "User not found/No longer exists";   
        } else echo "Error retrieving user: " . $con->error;

        $title = "Update Record";
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Updating User Details</title>

        <link rel="stylesheet" href="style.css" />
        <style>
        p {
            font-size: 20px;
        }

        form input {
            font-size: 24px;
            margin-bottom: 1rem;
            width: 20%;
        }

        label {
            font-size: 20px;
        }

        #isbn {
            background-color: gray;
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
        <h1>Insert New Record</h1>

        <div id="form">
            <form action="DBInsertRecord.php" method="post" autocomplete="nope">
                <label for="name">ISBN</label>
                <input type="text" name="name" id="name" placeholder="ISBN" autocomplete="off" <?php
                    if(isset($_GET['user_id'])) {
                        ?> value="<?= $user_data['first_name'] . ' ' . $user_data['last_name']; ?>" <?php
                    }
                    ?> disabled>
                <br>
                <label for="bookname">Book Name</label>
                <input type="text" name="bookname" id="bookname" placeholder="Book Name" autocomplete="off" min="1" <?php
                    if(isset($_GET['isbn'])) {
                        ?> value=" <?= $user_data['bookname']; ?>" <?php
                    }
                    ?>>
                <br>
                <label for="booktype">Book Type</label>
                <input type="text" name="booktype" id="booktype" placeholder="Book Type" autocomplete="off" <?php
                    if(isset($_GET['isbn'])) {
                        ?> value=" <?= $user_data['booktype']; ?>" <?php
                    }
                    ?>>
                <br>
                <label for="quantity">Quantity</label>
                <input type="text" name="quantity" id="quantity" placeholder="Quantity" autocomplete="off" <?php
                    if(isset($_GET['isbn'])) {
                        ?> value=" <?= $user_data['quantity']; ?>" <?php
                    }
                    ?>>
                <br>
                <label for="price">Price</label>
                <input type="text" name="price" id="price" placeholder="Price" autocomplete="off" <?php
                    if(isset($_GET['isbn'])) {
                        ?> value=" <?= $user_data['price']; ?>" <?php
                    }
                    ?>>

                <hr />
                <br />

                <input type="submit" value="Submit" />
                <input type="reset" value="Reset" />
            </form>
        </div>
    </body>
</html>
