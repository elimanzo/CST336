<?php
session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:adminLogin.php");
}
include "../../dbConnection.php";
$conn = getDatabaseConnection("bookstore");

function getGenres() {
    global $conn;
    
    $sql = "SELECT genreId, genreName from genres ORDER BY genreName";
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo "<option value='".$record["genreId"] ."'>". $record['genreName'] ." </option>";
    }
}

function getAuthors() {
    global $conn;
    
    $sql = "SELECT authorId, firstName, lastName from authors ORDER BY firstName";
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo "<option value='".$record["authorId"] ."'>". $record['firstName'] ." ".$record['lastName']." </option>";
    }
}

if (isset($_GET['submitBook'])) {
    $bookName = $_GET['bookName'];
    $bookDescription = $_GET['bookDescription'];
    $bookImage = $_GET['bookImage'];
    $bookPrice = $_GET['price'];
    $publishYear = $_GET['publishYear'];
    $bookPublisher = $_GET['bookPublisher'];
    $genreId = $_GET['genreId'];
    $authorId = $_GET['authorId'];
    
    $sql = "INSERT INTO books
            ( `bookName`, `bookDescription`, `bookImage`, `price`, `genreId`, `authorId`, `publishYear`, `bookPublisher`) 
             VALUES ( :bookName, :bookDescription, :bookImage, :price, :genreId, :authorId, :publishYear, :bookPublisher)";
    
    $namedParameters = array();
    $namedParameters[':bookName'] = $bookName;
    $namedParameters[':bookDescription'] = $bookDescription;
    $namedParameters[':bookImage'] = $bookImage;
    $namedParameters[':price'] = $bookPrice;
    $namedParameters[':genreId'] = $genreId;
    $namedParameters[':authorId'] = $authorId;
    $namedParameters[':publishYear'] = $publishYear;
    $namedParameters[':bookPublisher'] = $bookPublisher;
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title> Add a book </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body class = 'bg-dark'>
        <h1 class = 'display-4'><strong>Add A Book</strong> </h1>
        <div class = "container">
            <div class = "row">
                <div class = "col-md-8 offset-md-2">
                    <form>
                        <strong>Book Name</strong> <input type="text"  class="form-control"name="bookName"><br>
                        <strong>Description</strong> <textarea name="bookDescription"  class="form-control" cols = 50 rows = 4></textarea><br>
                        <strong>Price</strong> <input type="text" class="form-control" name="price"><br>
                        <strong>Publisher</strong> <input type="text" class="form-control" name="bookPublisher"><br>
                        <strong>Publish Year</strong> <input type="text" class="form-control" name="publishYear"><br>
                        <strong>Genre</strong> <select name="genreId" class="form-control">
                            <option value="">Select One</option>
                            <?php getGenres(); ?>
                        </select> <br />
                        <strong>Author</strong> <select name="authorId" class="form-control">
                            <option value="">Select One</option>
                            <?php getAuthors(); ?>
                        </select> <br />
                        <strong>Set Image Url</strong> <input type = "text" name = "bookImage" class="form-control"><br>
                        <input type="submit" name="submitBook"  class='btn btn-primary' value="Add Book">
                    </form>
                    </br>
                    <form action="admin.php">
                        <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Back to Admin Panel"/>
                    </form>
            </div>
        </div>
    </body>
</html>