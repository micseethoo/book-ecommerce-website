<?php

    require "connection.php";

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Add a New Book</title>

        <link rel="stylesheet" href="css/book_edit.css" />
    </head>
    <body>
        <a href="view-books.php"><button id="back">Back</button></a>
        <h1>Add new books</h1>
            <div id="form">
                <form action="add-books.php" method="post" autocomplete="nope" enctype="multipart/form-data">
                    <div class="isbnfield">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" id="isbn" placeholder="ISBN" autocomplete="off" required>
                    </div>
                    <br>
                    <label for="bookname">Book Name</label>
                    <input type="text" name="bookname" id="bookname" placeholder="Book Name" autocomplete="off" required>
                    <br>
                    <div class="imagefield">
                        <label for="bookimage">Book Image</label>
                        <input type="file" name="image" id="image" accept="image/*" required>
                    </div>
                    <br>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" autocomplete="off" required></textarea>
                    <br>
                    <label for="Category">Category</label>
                    <input type="text" name="category" id="category" placeholder="Category" autocomplete="off"  min="1" required>
                    <br>
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity" autocomplete="off"  min="1" required>
                    <br>
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" placeholder="Price" autocomplete="off" step=".01" required>
                    
                    <hr />
                    <br />
                    
                    <input type="submit" value="Submit" name="submit" id="submit_btn"/>
                    <input type="reset" value="Reset" id="reset_btn" />
                </form>
            </div>
    </body>
</html>