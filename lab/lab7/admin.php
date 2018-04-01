<?php

session_start();

function displayAllProducts() {
    global $conn;
    
    $sql = "SELECT productName, produxtDescription, price FROM `om_"
    
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page </title>
    </head>
    <body>


        
        <h1> Admin Main Page </h1>
        
        <h3> Welcome <?=$_SESSION['adminName']?>! </h3>
        
        <br />
        
        <?=displayAllProducts()?>

    </body>
</html>