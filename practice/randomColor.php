<?php
    function randomColor() {
        echo "rgba(".rand(0, 255).", ".rand(0, 255).", 
        ".rand(0, 255).", ".$alpha = (rand(0, 100) / 100).");";
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <title> Random Color</title>
        <style>
            body {
                background-color: <?= randomColor()?>
                color: <?php randomColor()?>
            }
            h1 {
                color: <?php randomColor()?>
            }
            h2 {
                background-color: <?= randomColor() ?>
            }
            
        </style>
    </head>
    <body>
        
        <h1> Welcome!</h1>
        <h2> Random Background Color! </h2>
    </body>
</html>