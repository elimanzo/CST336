<?php

 include '../../dbConnection.php';
    
 $connection = getDatabaseConnection("bookstore");
    
 $sql = "DELETE FROM authors WHERE authorId =  " . $_GET['authorId'];
 $statement = $connection->prepare($sql);
 $statement->execute();
 header("Location: admin.php");
?>