<?php
session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:adminLogin.php");
}
include "../../dbConnection.php";
$conn = getDatabaseConnection("bookstore");


if (isset($_GET['submitAuthor'])) {
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $age = $_GET['age'];
    $gender = $_GET['gender'];
    
    $sql = "INSERT INTO authors
            ( `firstName`, `lastName`, `gender`, `age`) 
             VALUES ( :firstName, :lastName, :gender, :age)";
    
    $namedParameters = array();
    $namedParameters[':firstName'] = $firstName;
    $namedParameters[':lastName'] = $lastName;
    $namedParameters[':gender'] = $gender;
    $namedParameters[':age'] = $age;
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
        <title> Add a Author </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body class = 'bg-dark'>
        <h1 class = 'display-4'><strong>Add A Author</strong> </h1>
        <div class = "container">
            <div class = "row">
                <div class = "col-md-8 offset-md-2">
                    <form>
                        <strong>First Name</strong> <input type="text"  class="form-control"name="firstName"><br>
                        <strong>Last Name</strong> <input type="text"  class="form-control"name="lastName"><br>
                        <strong>Gender</strong> <input type="text"  class="form-control"name="gender"><br>
                        <strong>Age</strong> <input type="text"  class="form-control"name="age"><br>
                        <input type="submit" name="submitAuthor"  class='btn btn-primary' value="Add Author">
                    </form>
                    </br>
                    <form action="admin.php">
                        <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Back to Admin Panel"/>
                    </form>
            </div>
        </div>
    </body>
</html>