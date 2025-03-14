<?php
    if(isset($_GET['isbn'])) {
        require "connection.php";

        $query = "SELECT * FROM `books` WHERE `isbn` = ". $_GET['isbn'] . ";";

        $result = mysqli_query($con,$query);
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Insert New Record</title>

        <link rel="stylesheet" href="css/book_edit.css" />
    </head>
    <body>
    <a href="view-books.php"><button id="back">Back</button></a>
        <h1>Update Book Quantity and Pricing</h1>

        <?php
            if ($result) {
                if ($result->num_rows > 0) {
                    $user_data = $result->fetch_assoc();
            ?>
            <div id="form">
                <form action="book-update.php" method="post" autocomplete="nope">
                    <div class="isbnfield">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" id="isbn" placeholder="ISBN" autocomplete="off" value="<?= $user_data["isbn"]; ?>" required readonly>
                    </div>
                    <br>
                    <label for="bookname">Book Name</label>
                    <input type="text" name="bookname" id="bookname" placeholder="Book Name" autocomplete="off" value="<?= $user_data["bookname"]; ?>" required readonly>
                    <br>
                    <div class="imagefield">
                        <label for="bookimage">Book Image</label>
                        <input type="file" name="bookimage" id="bookimage" accept="image/png, image/gif, image/jpeg">
                    </div>
                    <br>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" autocomplete="off" required readonly><?php echo $user_data["description"]; ?></textarea>
                    <br>
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity" autocomplete="off"  min="1" value="<?= $user_data["quantity"]; ?>" required>
                    <br>
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" placeholder="Price" autocomplete="off" step=".01" value="<?= $user_data["price"]; ?>" required>
    
                    <hr />
                    <br />
                    
                    <input type="submit" value="Submit" id="submit_btn"/>
                    <input type="reset" value="Reset" id="reset_btn"/>
                </form>
            </div>
        <?php
            } else echo "No data found.";
        } else echo "Error retrieving results: " . $conn->error;
        ?>
    </body>
</html>
