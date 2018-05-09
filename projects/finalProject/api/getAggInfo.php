<?php
    include '../../../dbConnection.php';
    $conn = getDatabaseConnection("bookstore");
    
    $sql = "SELECT COUNT(*) AS totalBooks, ROUND(AVG(price),2) average, ROUND(MAX(price),2) max, ROUND(MIN(price),2) min FROM books";
    
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $record=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($record);
?>