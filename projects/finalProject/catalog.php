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
                 
                 if ($_GET['orderBy'] == "priceA") {
                     
                    $sql .= " ORDER BY price";
                  
                 } else if ($_GET['orderBy'] == "priceD"){
                     
                    $sql .= " ORDER BY price DESC"; 
                    
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
        <title>Book Page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
      	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
      	<link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body class = 'bg-dark'>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="http://csumb.edu">CSUMB</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href='index.php' id='home'>
                    <i class="fas fa-home"></i>
                    Home </a>
            </li>
              <li class="nav-item  active">
                <a class="nav-link" href="catalog.php" id = 'catalog'>
                    <i class="fas fa-book"></i>
                    Catalog<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminLogin.php" id = 'login'>
                    <i class="fas fa-sign-in-alt"></i>
                    Login</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="about.php" id = 'about'>
                    <i class="fas fa-info-circle"></i>
                    About Us</a>
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
    <h1 class="display-3">Catalog!</h1>
    <div class='container'>
        <div class='text-center'>
            
            </br>
            <div class = "col-md-6 offset-md-3">
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
                    <input type="radio" id="customRadioInline1" name="orderBy"  value="priceA" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Price (ASC)</label>
                </div>
                <br />
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="orderBy" value="priceD"class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Price (DESC)</label>
                </div>
                <br />
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline3" name="orderBy" value="name"class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline3">Name</label>
                </div>
                <br />
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline4" name="orderBy" value="year"class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline4">Publish Year</label>
                </div>
                <br /><br />
                <input type="submit" name = "searchForm" value="Submit" class="btn btn-default">
                <br /><br />
            </form>
            </div>
            <script>
    
            $(document).ready(function(){
    
            //$("#adoptionsLink").addClass("active");
            
            $(".bookLink").click(function(){
                
                //alert(  );
                
                $('#bookModal').modal("show");
                $("#bookInfo").html("<img src='img/loading.gif'>");
                      
                
                $.ajax({

                    type: "GET",
                    url: "api/getBookInfo.php",
                    dataType: "json",
                    data: { "bookId": $(this).attr("id")},
                    success: function(data,status) {
                       //alert(data.breed);
                       //log.console(data.pictureURL);
                       
                       $("#bookModalLabel").html("<h2>" + data.bookName +"</h2>");
                       $("#bookInfo").html("");
                       $("#bookInfo").append("<img src='" + data.bookImage +"' width='200' >"+ "<br><br>");
                       $("#bookInfo").append("<strong>Author:</strong> " + data.firstName + " " + data.lastName + "<br><br>");
                       $("#bookInfo").append("<strong>Description:</strong>  " + data.bookDescription + "<br><br>");
                       $("#bookInfo").append("<strong>Publisher:</strong>  " + data.bookPublisher + "<br><br>");
                       $("#bookInfo").append("<strong>Year Published:</strong>  " + data.publishYear + "<br><br>");
                       $("#bookInfo").append("<strong>Genre:</strong>  " + data.genreName + "<br><br>");
                       $("#bookInfo").append("<strong>Genre Description:</strong>  " + data.genreDescription + "<br><br>");
                       $("#bookInfo").append("<strong>Price:</strong>  $" + data.price + "<br><br>");
                    
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                });//ajax
            });
    }); //document ready
</script>
            <!-- Display Search Results -->

            <?php displayResults(); ?>
            
            <div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width:1250px;" role="document" >
                    <div class="modal-content" >
                        <div class="modal-header" >
                        <h5 class="modal-title" id="bookModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <div id="bookInfo"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include 'inc/footer.php';
        ?>
    </div>

    </body>

</html>