<?php
    require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Record | Admin Database</title>
        <!-- <link rel="stylesheet" href="css/admin_nav.css"> -->
        <link rel="stylesheet" href="css/bookslist.css">
        <script>
        function confirmdelete(isbn) {
            let comf_del = confirm(`Do you wish to delete Book with ISBN #${isbn}?`);
            if (comf_del) window.location.href = `delete-books.php?isbn=${isbn}`;
        }
        </script>
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
        <main>
        <h1>List of All Books</h1>

        <div>
            <table>
                <tr>
                    <th id="book_isbn">ISBN</th>
                    <th>Product Image</th>
                    <th id="book_name">Book Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM `books`;";

                $sql_run = $con->query($sql);

                if($sql_run) {  // if it is not false, then proceed
                    if($sql_run->num_rows > 0) {    // num_rows will check if there are row(s) of results
                        while($row = $sql_run->fetch_assoc()) {
                            ?>
                <tr>
                    <td><?= $row['isbn']; ?></td>
                    <td><?php echo '<img id="product_image" alt="book image" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="200px" height="300px">'; ?></td>
                    <td><?= $row['bookname']; ?></td>
                    <td><textarea name="" id="" cols="40" rows="10" readonly placeholder="Description"><?= $row['description']; ?></textarea></td>
                    <td><?= $row['quantity']; ?></td>
                    <td><?= $row['price']; ?></td>
                    <td><?= $row['category']; ?></td>
                    <td>
                    <button onclick="document.location.href = 'edit-books-form.php?isbn=<?= $row['isbn']; ?>'" id="edit">Edit</button>
                    <button onclick="confirmdelete(<?= $row['isbn']; ?>)" id="delete">Delete</button>
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
        <br>
        <div class="addbooks">
            <a href="new-books-form.php" id="addbooks">Add New Books</a>
        </div>
    </main>
    </body>
</html>
