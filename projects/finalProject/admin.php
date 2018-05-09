<?php

session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:bookLogin.php");
}
include '../../dbConnection.php';
$conn = getDatabaseConnection("bookstore");

function displayAllBooks(){
    global $conn;
    $sql="SELECT * FROM books ORDER BY bookId";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}

function displayAllAuthors(){
    global $conn;
    $sql="SELECT * FROM authors ORDER BY authorId";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}

function displayAllGenres(){
    global $conn;
    $sql="SELECT * FROM genres ORDER BY genreId";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <title>Admin Main Page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
      	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
      	<link href="css/styles.css" rel="stylesheet" type="text/css" />       
        <script>
            $(document).ready(function(){
                $("#getData").click(function(){
                    $.ajax({
                        type: "GET",
                        url: "api/getAggInfo.php",
                        dataType: "json",
                        data: { "id" : "" },
                        success: function(data,status) {
                                $("#Agg").html("");
                                $("#Agg").append("<strong>Total Books:</strong> " + data[0].totalBooks + "<br><br>");
                                $("#Agg").append("<strong>Average Book Price:</strong>  $" + data[0].average + "<br><br>");
                                $("#Agg").append("<strong>Max Book Price:</strong>  $" + data[0].max + "<br><br>");
                                $("#Agg").append("<strong>Min Book Price:</strong>  $" + data[0].min + "<br><br>");
                        }
                    });
                });
            });
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete the book?");
                
            }
            function confirmDelete2() {
                
                return confirm("Are you sure you want to delete the author?");
                
            }
            function confirmDelete3() {
                
                return confirm("Are you sure you want to delete the author?");
                
            }
            
        </script>
        
    </head>
    <body class = 'bg-dark'>

        <h1 class="display-3">Admin Panel</h1>
        <div class = "container">    
            <h2 class = 'display-4' id = "welcome" ><strong> Welcome <?=$_SESSION['adminName']?>! </strong></h3>
            
            <br />
            <form action="addBook.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" name="addbook" value="Add Book"/>
            </form>
            <br/>
            <form action="addAuthor.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" name="addauthor" value="Add Author"/>
            </form>
            <br/>
            <form action="addGenre.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" name="addgenre" value="Add Genre"/>
            </form>
            <br/>
            <form action="logout.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
            </form>
            <br/>
            <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#bookTable" aria-expanded="false" aria-controls="bookTable">
                Show Book Information
            </button>
            </p>
            <div class="collapse" id="bookTable">
                    <br /> <br />
                    <h2 class = 'display-4' id = "welcome" > Books </h3><br />
                    <?php $records=displayAllBooks();
                        echo "<table class='table table-hover'>";
                        echo "<thead> 
                                <tr>
                                  <th scope='col'>ID</th>
                                  <th scope='col'>Book Name</th>
                                  <th scope='col'>Book Description</th>
                                  <th scope='col'>Book Publisher</th>
                                  <th scope='col'>Year Published</th>
                                  <th scope='col'>Price</th>
                                  <th scope='col'>Update</th>
                                  <th scope='col'>Remove</th>
                                 </tr>
                                </thead>";
                        echo"<tbody>";
                        foreach($records as $record) {
                            echo "<tr>";
                            echo "<td>" .$record['bookId']."</td>";
                            echo "<td>" .$record["bookName"]."</td>";
                            echo "<td>" .$record["bookDescription"]."</td>";
                            echo "<td>" .$record["bookPublisher"]."</td>";
                            echo "<td>" .$record["publishYear"]."</td>";
                            echo "<td>$" .$record["price"]."</td>";
                            echo "<td><a class='btn btn-primary' href='updateBook.php?bookId=".$record['bookId']."'>Update</a></td>";
                            echo "<form action='deleteBook.php' onsubmit='return confirmDelete()'>";
                            echo "<input type='hidden' name='bookId' value= " . $record['bookId'] . " />";
                            echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
                            echo "</form>";
                        }
                        echo"</tbody>";
                        echo"</table> ";
                    ?>
            </div>
            <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#authorTable" aria-expanded="false" aria-controls="authorTable">
                Show Author Information
            </button>
            </p>
            <div class="collapse" id="authorTable">
                    <br /> <br />
                    <h2 class = 'display-4' id = "welcome" > Authors </h3><br />
                    <?php $records=displayAllAuthors();
                        echo "<table class='table table-hover'>";
                        echo "<thead> 
                                <tr>
                                  <th scope='col'>ID</th>
                                  <th scope='col'>First Name</th>
                                  <th scope='col'>Last Name</th>
                                  <th scope='col'>Gender</th>
                                  <th scope='col'>Age</th>
                                  <th scope='col'>Update</th>
                                  <th scope='col'>Remove</th>
                                 </tr>
                                </thead>";
                        echo"<tbody>";
                        foreach($records as $record) {
                            echo "<tr>";
                            echo "<td>" .$record['authorId']."</td>";
                            echo "<td>" .$record["firstName"]."</td>";
                            echo "<td>" .$record["lastName"]."</td>";
                            echo "<td>" .$record["gender"]."</td>";
                            echo "<td>" .$record["age"]."</td>";
                            echo "<td><a class='btn btn-primary' href='updateAuthor.php?authorId=".$record['authorId']."'>Update</a></td>";
                            echo "<form action='deleteAuthor.php' onsubmit='return confirmDelete2()'>";
                            echo "<input type='hidden' name='authorId' value= " . $record['authorId'] . " />";
                            echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
                            echo "</form>";
                        }
                        echo"</tbody>";
                        echo"</table> ";
                    ?>
            </div>
            <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#genreTable" aria-expanded="false" aria-controls="genreTable">
                Show Genre Information
            </button>
            </p>
            <div class="collapse" id="genreTable">
                    <br /> <br />
                    <h2 class = 'display-4' id = "welcome" > Genres </h3><br />
                    <?php $records=displayAllGenres();
                        echo "<table class='table table-hover'>";
                        echo "<thead> 
                                <tr>
                                  <th scope='col'>ID</th>
                                  <th scope='col'>Genre Name</th>
                                  <th scope='col'>Genre Description</th>
                                  <th scope='col'>Update</th>
                                  <th scope='col'>Remove</th>
                                 </tr>
                                </thead>";
                        echo"<tbody>";
                        foreach($records as $record) {
                            echo "<tr>";
                            echo "<td>" .$record['genreId']."</td>";
                            echo "<td>" .$record["genreName"]."</td>";
                            echo "<td>" .$record["genreDescription"]."</td>";
                            echo "<td><a class='btn btn-primary' href='updateGenre.php?genreId=".$record['genreId']."'>Update</a></td>";
                            echo "<form action='deleteGenre.php' onsubmit='return confirmDelete3()'>";
                            echo "<input type='hidden' name='genreId' value= " . $record['genreId'] . " />";
                            echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
                            echo "</form>";
                        }
                        echo"</tbody>";
                        echo"</table> ";
                    ?>
            </div>
            <p>
              <a class="btn btn-primary" id="getData" data-toggle="collapse" href="#Agg" role="button" aria-expanded="false" aria-controls="Agg">
                Data Analysis 
              </a>
            </p>
            <div class="collapse" id="Agg">
            </div>
            
            
        </div>
    </body>
</html>