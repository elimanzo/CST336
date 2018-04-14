<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Login </title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>

        <h1 class = 'display-4'><strong>OtterMart - Admin Login </strong> </h1>
        
        <div class = "container">
            <div class = "row">
                <div class = "col-md-6 offset-md-3">
                    <form  method="POST" action="loginProcess.php">
                    <div class="form-group">
                        <label for="username"><strong>Username</strong></label>
                        <input type="text" class="form-control" name="username" id ='username' placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="passwords"><strong>Password</strong></label>
                        <input type="password" class="form-control" name="password" id="passwords" placeholder="Password">
                    </div>
                    <br />
                    <input type="submit" class ='btn btn-primary' name="submitForm" value="Login!" />
                    <br /><br />
                    <?php 
                        if($_SESSION['incorrect'] == true){
                            echo "<p class = 'lead' id = 'error' style='color:red'>";
                            echo "<strong>Incorrect Username or Password!</strong></p>";
                        }
                    ?>
                    </form>                   
                </div>
            </div>
        </div>
        


    </body>
</html>