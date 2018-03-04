<?php
    include 'inc/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Silver Jack Game</title>
        <meta charset = "utf-8" />
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        <div id = "main">
            <?=playCards()?>
            <form>
                <input type="submit" value="Play!"/>
            </form>
        </div>
    </body>
</html>