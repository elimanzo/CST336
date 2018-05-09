<?php
    session_start();
    include 'inc/functions.php';
    
    if(isset($_POST['removeId'])) {
        foreach($_SESSION['cart'] as $itemKey => $item) {
            if($item['id'] == $_POST['removeId']) {
                unset($_SESSION['cart'][$itemKey]);
            }
        }
    }
    if(isset($_POST['itemId'])) {
        foreach($_SESSION['cart'] as &$item) {
            if($item['id'] == $_POST['itemId']) {
                $item['quantity'] = $_POST['update'];
            }
        }
    }
    
    if(isset($_POST['clearCart'])){
        //if (session_status() == PHP_SESSION_ACTIVE) { session_destroy(); }
        foreach($_SESSION['cart'] as $itemKey => $item) {
            unset($_SESSION['cart'][$itemKey]);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <title>Shopping Cart</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
      	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
      	<link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body class = "bg-dark">
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
              <li class="nav-item">
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
                <li class="nav-item active">
                    <a class="nav-link" href='scart.php'>
                        <i class="fas fa-shopping-cart"></i>
                        Cart: <?php displayCartCount(); ?> </a></li>
                    </a>
                </li>
            </ul>
          </div>
        </nav>
        <div class='container'>
            <div class='text-center'>
                
                <!-- Bootstrap Navagation Bar -->
                <br /> <br /> <br />
                <h2>Shopping Cart</h2>
                <!-- Cart Items -->
                <?php
                    displayCart();
                    echo "<hr>"; 
                    clearCart();
                ?>
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

        </div>
    
    </body>
</html>