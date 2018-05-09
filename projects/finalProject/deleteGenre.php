<?php

 include '../../dbConnection.php';
    
 $connection = getDatabaseConnection("bookstore");
    
 $sql = "DELETE FROM genres WHERE genreId =  " . $_GET['genreId'];
 $statement = $connection->prepare($sql);
 $statement->execute();
 header("Location: admin.php");
?>