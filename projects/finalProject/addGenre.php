<?php
session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:adminLogin.php");
}
include "../../dbConnection.php";
$conn = getDatabaseConnection("bookstore");


if (isset($_GET['submitGenre'])) {
    $genreName = $_GET['genreName'];
    $genreDescription = $_GET['genreDescription'];
    
    $sql = "INSERT INTO genres
            ( `genreName`, `genreDescription`) 
             VALUES ( :genreName, :genreDescription)";
    
    $namedParameters = array();
    $namedParameters[':genreName'] = $genreName;
    $namedParameters[':genreDescription'] = $genreDescription;
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
        <title> Add a Genre </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body class = 'bg-dark'>
        <h1 class = 'display-4'><strong>Add A Genre</strong> </h1>
        <div class = "container">
            <div class = "row">
                <div class = "col-md-8 offset-md-2">
                    <form>
                        <strong>Genre Name</strong> <input type="text"  class="form-control"name="genreName"><br>
                        <strong>Genre Description</strong> <textarea name="genreDescription"  class="form-control" cols = 50 rows = 4></textarea><br>
                        <input type="submit" name="submitGenre"  class='btn btn-primary' value="Add Genre">
                    </form>
                    </br>
                    <form action="admin.php">
                        <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Back to Admin Panel"/>
                    </form>
            </div>
        </div>
    </body>
</html>