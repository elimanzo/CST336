<?php
    include '../../dbConnection.php';
    
    $connection = getDatabaseConnection("bookstore");
    
    function getGenres($genreId) {
        global $connection;
        
        $sql = "SELECT genreId, genreName from genres ORDER BY genreName";
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option  ";
            echo ($record["genreId"] == $genreId)? "selected": ""; 
            echo " value='".$record["genreId"] ."'>". $record['genreName'] ." </option>";
        }
    }
    
    function getAuthors($authorId) {
        global $connection;
        
        $sql = "SELECT authorId, firstName, lastName from authors ORDER BY firstName";
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option  ";
            echo ($record["authorId"] == $authorId)? "selected": ""; 
            echo " value='".$record["authorId"] ."'>". $record['firstName'] ." ".$record['lastName']." </option>";
        }
    }
    
    function getBookInfo()
    {
        global $connection;
        $sql = "SELECT * FROM books WHERE bookId = " . $_GET['bookId'];
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    
    if (isset($_GET['updateBook'])) {
        
        //echo "Trying to update the product!";
        
        $sql = "UPDATE books
                SET bookName = :bookName,
                    bookDescription = :bookDescription,
                    bookImage = :bookImage,
                    price = :price,
                    publishYear = :publishYear,
                    bookPublisher = :bookPublisher,
                    genreId = :genreId,
                    authorId = :authorId
                WHERE bookId = :bookId";
                
        $np = array();
        $np[":bookName"] = $_GET['bookName'];
        $np[":bookDescription"] = $_GET['bookDescription'];
        $np[":bookImage"] = $_GET['bookImage'];
        $np[":price"] = $_GET['price'];
        $np[":publishYear"] = $_GET['publishYear'];
        $np[":bookPublisher"] = $_GET['bookPublisher'];
        $np[":genreId"] = $_GET['genreId'];
        $np[":authorId"] = $_GET['authorId'];
        $np[":bookId"] = $_GET['bookId'];
                
        $statement = $connection->prepare($sql);
        $statement->execute($np);        
        echo "Book has been updated!";
        
    }
    
    
    if(isset ($_GET['bookId']))
    {
        $book = getBookInfo();
    }
    
    //print_r($product);
    
    
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Update Product </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body class = 'bg-dark'>
        <h1 class = 'display-3'>Update Product</h1>
        <div class = "container">
            <div class = "row">
                <div class = "col-md-8 offset-md-2">
                    <form>
                        <input type="hidden" name="bookId" value= "<?=$book['bookId']?>"/>
                        <strong>Book name</strong> <input type="text" class="form-control" value = "<?=$book['bookName']?>" name="bookName"><br>
                        <strong>Book Description</strong> <textarea name="bookDescription" class="form-control" cols = 50 rows = 4><?=$book['bookDescription']?></textarea><br>
                        <strong>Price</strong> <input type="text"  class="form-control" name="price" value = "<?=$book['price']?>"><br>
                        <strong>Publisher</strong> <input type="text" class="form-control" name="bookPublisher" value = "<?=$book['bookPublisher']?>"><br>
                        <strong>Publish Year</strong> <input type="text" class="form-control" name="publishYear" value = "<?=$book['publishYear']?>"><br>
                        <strong>Genres</strong> <select name="genreId" class="form-control">
                            <option>Select One</option>
                            <?php getGenres( $book['genreId'] ); ?>
                        </select> <br />
                        <strong>Authors</strong> <select name="authorId" class="form-control">
                            <option>Select One</option>
                            <?php getAuthors( $book['authorId'] ); ?>
                        </select> <br />
                        <strong>Set Image Url</strong> <input type = "text" class="form-control" name = "bookImage" value = "<?=$book['bookImage']?>"><br>
                        <input type="submit" class='btn btn-primary' name="updateBook" value="Update Book">
                    </form>
                    </br>
                    <form action="admin.php">
                        <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Back to Admin Panel"/>
                    </form>
            </div>
        </div>
    </div>
    </body>
</html>