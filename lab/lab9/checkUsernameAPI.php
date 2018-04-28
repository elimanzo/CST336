<?php

    include '../../dbConnection.php';
    $conn = getDatabaseConnection("c9");
    $username = $_GET['username'];
    $sql = "SELECT * FROM lab9_user WHERE username = :username";
    $names = array();
    $names[':username'] = $username;
    $stmt = $conn->prepare($sql);
    $stmt->execute($names);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($record);

?>