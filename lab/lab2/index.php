<?php
 include 'inc/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 2: 777 Slot Machine </title>
        <meta charset = "utf-8" />
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        <div id = "main">
            <?php
                play();
            ?>
            <form>
                <input type="submit" value="Spin!"/>
            </form>
        </div>
        
        <br /><br /><br />
        
        <footer>
            Image sources: <br>
            http://www.modern-canvas-art.com/ekmps/shops/robboweb1/images/slot-machine-symbols-pop-art-canvas-print-4252-p.jpg
            <br />
            http://www.freeslotmachines.me.uk/
            <br />
            http://img.over-blog-kiwi.com/1/18/84/05/20140812/ob_3ea045_slotmachine-wallpaper-777.jpg
        </footer>
    </body>
</html>