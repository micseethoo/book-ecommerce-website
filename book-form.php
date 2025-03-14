<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Insert New Record</title>

        <link rel="stylesheet" href="style.css" />
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap');

        body {
            font-family: 'Source Code Pro', monospace;
        }
        
        h1 {
            text-align: center;
        }
        p {
            font-size: 20px;
        }

        form input {
            display: block;
            margin: 0 auto;
            font-size: 24px;
            margin-bottom: 1rem;
            width: 400px;
        }

        form label {
            display: block;
            margin: 0 auto;
            margin-bottom: 5px;
            font-size: 24px;
            width: 410px;
        }

        label {
            font-size: 20px;
        }

        label, input {
            display: block;
        }

        #form {
            display: block;
            margin: 0 auto;
        }

        /* #isbn {
            background-color: gray;
        } */

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #description {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 400px;
        }
        </style>
    </head>

    <body>
        <h1>Add new books</h1>
            <div id="form">
                <form action="add-books.php" method="post" autocomplete="nope">
                    <!-- <div class="isbnfield">
                        <label for="isbn">ISBN</label>
                        <input type="number" name="isbn" id="isbn" placeholder="ISBN" autocomplete="off" required>
                    </div>
                    <br>
                    <label for="bookname">Book Name</label>
                    <input type="text" name="bookname" id="bookname" placeholder="Book Name" autocomplete="off" required>
                    <br>
                    <label for="booktype">Book Type</label>
                    <input type="text" name="booktype" id="booktype" placeholder="Book Type" autocomplete="off" required>
                    <br>
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity" autocomplete="off"  min="1" required>
                    <br>
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" placeholder="Price" autocomplete="off" step=".01" required> -->
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
                        <input type="file" name="bookimage" id="bookimage" accept="image/png, image/gif, image/jpeg" required>
                    </div>
                    <br>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" autocomplete="off" required></textarea>
                    <br>
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity" autocomplete="off"  min="1" required>
                    <br>
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" placeholder="Price" autocomplete="off" step=".01" required>
                    
                    <hr />
                    <br />
                    
                    <input type="submit" value="Submit" />
                    <input type="reset" value="Reset" />
                </form>
            </div>