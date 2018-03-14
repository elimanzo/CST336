<?php
 include 'inc/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tic - Tac - Toe</title>
        <meta charset = "utf-8" />
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        <header>
            <img id="title" src="img/titles.png" alt="Title"></img>
        </header>
        <br/>
        <div id = "main">
            <?php
                play()
            ?>
            <hr>
            <img id="board" src="img/board.png" alt="Board"></img>
            <form>
                <input type="submit" value="Generate"/>
            </form>
            <h2 id ="myPlayer">Player: X</h2>
            <h2 id ="myCpu">CPU: O</h2>
        </div>
        <footer>
            <hr>
             CST336 Internet Programming. 2018&copy; Manzo <br />
             <strong>Disclaimer:</strong> The images in this webpage is <br />  
             used for academic purposes only.<br />
            <br />
            <img id="csumbLogo" src="img/csumb_logo.png" alt="CSUMB Logo" />
        </footer>
    </body>
</html>