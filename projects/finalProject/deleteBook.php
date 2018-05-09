<?php

 include '../../dbConnection.php';
    
 $connection = getDatabaseConnection("bookstore");
    
 $sql = "DELETE FROM books WHERE bookId =  " . $_GET['bookId'];
 $statement = $connection->prepare($sql);
 $statement->execute();
 header("Location: admin.php");
?>