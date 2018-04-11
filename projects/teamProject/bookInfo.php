<?php
    include 'inc/functions.php';
    include '../../dbConnection.php';
    session_start();
    
    $conn = getDatabaseConnection("bookstore");
    
    function displayInfo(){
        global $conn;
        
        $bookId = $_GET['bookId'];

        $sql = "SELECT * FROM `books`
                NATURAL JOIN `authors` 
                NATURAL JOIN `genres`
                WHERE bookId = :bId";    
    
        $np = array();
        $np[":bId"] = $bookId;
    
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<div id='content'>";
        echo "<hr>";
        echo "<h2>";
        echo $records[0]['bookName']. "<br /><br/>";
        echo "</h2>";
        echo "<figure id='bookImage'>";
        echo "<img src='" . $records[0]['bookImage'] . "' /><br/>";
        echo "</figure>";
        
        echo "<aside id='bookInfo'>";
        echo "<h3>";
        echo "<b>Price: </b>$" .$records[0]['price']. "<br />";
        echo "<b>Author: </b>" .$records[0]['lastName']. ", " .$records[0]['firstName'];
        echo "</h3>";
        echo "<h4>";
        echo "<b>Publisher: </b>" .$records[0]['bookPublisher']. "<br />";
        echo "<b>Year Published: </b>" .$records[0]['publishYear'];
        echo "</h4>";
        echo "<h5>";
        echo "<b>Genre: </b>" .$records[0]['genreName']. "<br />";
        echo "<b>Genre Description: </b>" .$records[0]['genreDescription']. "<br />";
        echo "</h5>";
        echo "</aside>";
        echo "</div>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <title>Book Information</title>
    </head>
    <body>
        <div class='container'>
            <div class='text-center'>
                <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand mb-0 h1' href='index.php'>Bookstore</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li class="nav-item">
                            <a class="nav-link" href='index.php'>
                                <i class="fas fa-home"></i>
                                Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='scart.php'>
                                <i class="fas fa-shopping-cart"></i>
                                Cart: <?php displayCartCount(); ?> </a></li>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
                <br /> <br /> <br />
                <h2>Book Information</h2>
                <!-- BOOK INFORMATION -->
                <?php
                    displayInfo();
                ?>
            </div>
        </div>
    </body>
</html>
</html>