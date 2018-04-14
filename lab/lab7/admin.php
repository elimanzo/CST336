<?php

session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:index.php");
}
include '../../dbConnection.php';
$conn = getDatabaseConnection("ottermart");

function displayAllProducts(){
    global $conn;
    $sql="SELECT * FROM om_product ORDER BY productId";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);

    return $records;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title> Admin Main Page </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />        
        <script>
            
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete the product?");
                
            }
            
        </script>
        
    </head>
    <body>

        <h1 class = 'display-4'> <strong>Admin Main Page</strong> </h1>
        <div class = "container">    
            <h2 class = 'display-4' id = "welcome" ><strong> Welcome <?=$_SESSION['adminName']?>! </strong></h3>
            
            <br />
            <form action="addProduct.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" name="addproduct" value="Add Product"/>
            </form>
            <br/>
            <form action="logout.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
            </form>
            
            <br /> <br />
            <h2 class = 'display-4' id = "welcome" > Products </h3><br />
            
            
            <?php $records=displayAllProducts();
                echo "<table class='table table-hover'>";
                echo "<thead> 
                        <tr>
                          <th scope='col'>ID</th>
                          <th scope='col'>Name</th>
                          <th scope='col'>Description</th>
                          <th scope='col'>Price</th>
                          <th scope='col'>Update</th>
                          <th scope='col'>Remove</th>
                         </tr>
                        </thead>";
                echo"<tbody>";
                foreach($records as $record) {
                    echo "<tr>";
                    echo "<td>" .$record['productId']."</td>";
                    echo "<td>" .$record["productName"]."</td>";
                    echo "<td>" .$record["productDescription"]."</td>";
                    echo "<td>$" .$record["price"]."</td>";
                    echo "<td><a class='btn btn-primary' href='updateProduct.php?productId=".$record['productId']."'>Update</a></td>";
                    //echo "[<a href='deleteProduct.php?productId=".$record['productId']."'>Delete</a>]";
                    
                    echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                    echo "<input type='hidden' name='productId' value= " . $record['productId'] . " />";
                    echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
                    echo "</form>";
                    
                    
                    //echo '<br>';
                }
                echo"</tbody>";
                echo"</table> ";
            ?>
        </div>
        

    </body>
</html>