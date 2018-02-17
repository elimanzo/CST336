<?php
    function randomCard()
    {
        $suites_num = rand(1,4);
        $cards_num = rand(1,5);
        $card_name = "";
        $suites_name = "";
        switch($suites_num){
            case "1"; 
                $suites_name = "clubs";
                break;
            case "2":
                $suites_name = "diamonds";
                        break;
            case "3":  
                $suites_name = "hearts";
                        break;
            case "4": 
                $suites_name = "spades";
                        break;
        }
        switch($cards_num) {
            case "1": 
                $cards_name = "ace";
                        break;
            case "2":
                $cards_name = "jack";
                        break;
            case "3": 
                $cards_name = "queen";
                    break;
            case "4": 
                $cards_name = "king";
                        break;
            case "5": 
                $cards_name = "ace";
                        break;
        }
        $ten = 0;
        $jack = 1;
        $queen = 2;
        $king = 3;
        $ace = 4;
    
        echo "<img src='img/cards/$suites_name/$cards_name.png' width ='70' alt = \"". 
        ucfirst($cards_name) ."\" title = \"". ucfirst($cards_name) ."\"/>"; 
    
    }

    
?>



<!DOCTYPE html>
<html>
    <head>
        <title> Random Card Game</title>
        <!--<link href="css/styles.css" rel="stylesheet" type="text/css" />-->
    </head>
    <body>
        <?php randomCard() ?>
    </body>
</html>