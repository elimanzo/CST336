

<?php
    
    function displayResults() {
        
        global $items;
        
        if(isset($items)) {
                    
            echo "<hr>";
            echo "<h3>Products Found </h3>"; 
            echo "<br />";
            echo "<table class='table' >";
            
            foreach ($items as $item) {
                
                $itemName = $item['bookName'];
                $itemPrice = $item['price'];
                $itemImage = $item['bookImage'];
                $itemId = $item['bookId'];
                $itemYear = $item['publishYear'];
                
                echo "<tr>";
                echo "<td><img src='$itemImage'></td>";
                echo "<td><h4><a href=\"bookInfo.php?bookId=" . $item["bookId"] ."\" target='_blank' >$itemName</a></h4></td>";
                echo "<td><h4>$itemYear</h4></td>";
                echo "<td><h4>$$itemPrice</h4></td>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemName' value='$itemName'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<input type='hidden' name='itemImage' value='$itemImage'>";
                echo "<input type='hidden' name='itemYear' value='$itemYear'>";
                echo "<input type='hidden' name='itemPrice' value='$itemPrice'>";
                
                if($_POST['itemId'] == $itemId) {
                    
                    echo "<td><button class='btn btn-success'>Added</button></td>";
                }
                else {
                    
                    echo "<td><button class='btn btn-outline-secondary' >Add</button></td>";
                }
                
                echo "</form>";
                
                echo "</tr>";
            }
            
            echo "</table>";
        }
        
    }
    function displayCart() {
        
        if(isset($_SESSION['cart'])) {
            
            echo "<table class='table'>";
            foreach($_SESSION['cart'] as $item) {
                $itemId = $item['id'];
                $itemQuant = $item['quantity'];
                
                echo "<tr>";
                echo "<td><img src='" .$item['image']. "'></td>";
                echo "<td><h4><a href=\"bookInfo.php?bookId=" .$item['id']. "\" target='_blank' >".$item['name']."</a></h4></td>";
                echo "<td><h4>".$item['year']."</h4></td>";
                echo "<td><h4>$".$item['price']."</h4></td>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<td><input type='text' name='update' class='form-control' placeHolder='$itemQuant'></td>";
                echo "<td><button class='btn btn-outline-danger'>Update</button></td>";
                echo "</form>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='removeId' value='$itemId'>";
                echo "<td><button class='btn btn-outline-danger'>Remove</button></td>";
                echo "</form>";
                
                echo "</tr>";
            }
            
            echo "</table>";
        }
    }
    function displayCartCount() {
        echo count($_SESSION['cart']);
    }
    function clearCart(){
        echo "<form method='post'>";
        echo "<input type='hidden' name='clearCart' value='true'>";
        echo "<td><button class='btn btn-outline-danger'>Clear Cart</button></td>";
        echo "</form>";
    }
?>

