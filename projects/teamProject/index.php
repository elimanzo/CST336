<?php
    
    include 'inc/functions.php';
    include '../../dbConnection.php';
    session_start();
    
    $conn = getDatabaseConnection("bookstore");
    
    function displayGenres(){
        global $conn;
        
        $sql = "SELECT genreId, genreName FROM `genres` ORDER BY genreName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["genreId"]."' >" . $record["genreName"] . "</option>";
            
        }
        
    }
    
    
    if(!isset($_SESSION['cart'])) {
        
        $_SESSION['cart'] = array();
    }
    
    if(isset($_POST['itemName'])) {
        
        $newItem = array();
        $newItem['name'] = $_POST['itemName'];
        $newItem['id'] = $_POST['itemId'];
        $newItem['price'] = $_POST['itemPrice'];
        $newItem['image'] = $_POST['itemImage'];
        $newItem['year'] = $_POST['itemYear'];
        
        foreach($_SESSION['cart'] as &$item) {
            if($newItem['id'] == $item['id']) {
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        if($found != true) {
            $newItem['quantity'] = 1;
            array_push($_SESSION['cart'], $newItem);
        }
    }
    
    if(isset($_GET['searchForm'])) {
        global $conn;

        $namedParameters = array();
            
        $sql = "SELECT * FROM books WHERE 1";
            
            if (!empty($_GET['bookName'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND bookName LIKE :bookName";
                 $namedParameters[":bookName"] = "%" . $_GET['bookName'] . "%";
            }
            if (!empty($_GET['publisher'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND bookPublisher LIKE :bookPublisher";
                 $namedParameters[":bookPublisher"] = "%" . $_GET['publisher'] . "%";
            }
            if (!empty($_GET['genres'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND genreId = :genreId";
                 $namedParameters[":genreId"] =  $_GET['genres'];
            } 
             if (!empty($_GET['priceFrom'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND price >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
             }
             
            if (!empty($_GET['priceTo'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND price <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
             }
            
             if (isset($_GET['orderBy'])) {
                 
                 if ($_GET['orderBy'] == "price") {
                     
                    $sql .= " ORDER BY price";
                     
                 } else if ($_GET['orderBy'] == "year"){
                     
                    $sql .= " ORDER BY publishYear";
                    
                 } else {   
                     
                    $sql .= " ORDER BY bookName";
                 }
             }
        
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <title>Book Page</title>
        
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
                        <li class="nav-item active">
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
            
            <!-- Search Form -->
            <form enctype="text/plain">
                <div class="form-group">
                    <label for="bName"><strong>Book Name</strong></label>
                    <input type="text" class="form-control" name="bookName" id="bName" placeholder="Book Name">
                </div>
                <div class="form-group">
                    <label for="bName"><strong>Publisher</strong></label>
                    <input type="text" class="form-control" name="publisher" id="bName" placeholder="Publisher">
                </div>
                <label for="bName"><strong>Genres</strong> </label><br />
                <select class="custom-select" name="genres">
                    <option value=""> Select One </option>
                    <?=displayGenres()?>
                </select>
                <br /><br />
                
                
                <label for="bName"><strong>Price</strong></label>
                <div class="input-group mb-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text">From:</span>
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" name="priceFrom" class="form-control" aria-label="Amount (to the nearest dollar)">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="input-group mb-3" >
                    <div class="input-group-prepend" >
                        <span class="input-group-text">To: </span>
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" name="priceTo" class="form-control" aria-label="Amount (to the nearest dollar)">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <label for="bName"><strong>Order result by: </strong></label><br />
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="orderBy"  value="price" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Price</label>
                </div>
                <br />
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="orderBy" value="name"class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Name</label>
                </div>
                <br />
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline3" name="orderBy" value="year"class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline3">Publish Year</label>
                </div>
                <br /><br />
                <input type="submit" name = "searchForm" value="Submit" class="btn btn-default">
                <br /><br />
            </form>
            
            <!-- Display Search Results -->
            <?php displayResults(); ?>
        </div>
    </div>
    </body>
</html>