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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <title>Shopping Cart</title>
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
                        <li class="nav-item active">
                            <a class="nav-link" href='scart.php'>
                                <i class="fas fa-shopping-cart"></i>
                                Cart: <?php displayCartCount(); ?> </a></li>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
                <br /> <br /> <br />
                <h2>Shopping Cart</h2>
                <!-- Cart Items -->
                <?php
                    displayCart();
                    echo "<hr>"; 
                    clearCart();
                ?>
            </div>
        </div>
    </body>
</html>