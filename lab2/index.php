<!DOCTYPE html>
<html>
    <head>
        <title> Lab 2: 777 Slot Machine </title>
        <meta charset = "utf-8" />
    </head>
    <body>
        <?php
            function displaySymbol($randomValue) {
                // $randomValue = rand (0,4);
                switch ($randomValue) {
                    case "0":
                        $symbol = "seven";
                        break;
                    case "1":
                        $symbol = "orange";
                        break;
                    case "2":
                        $symbol = "cherry";
                        break;
                    case "3":
                        $symbol = "grapes";
                        break;
                    case "4":
                        $symbol = "lemon";
                        break;
                }
                echo "<img src='img/$symbol.png' width ='70' alt = \"". ucfirst($symbol) ."\" title = \"". ucfirst($symbol) ."\"/>";        
            }
            function displayPoints($randomValue1, $randomValue2, $randomValue3) {
                echo "-div id='output.>";
                if($randomValue1 == $randomValue2 && randomValue2 == $randomValue3) {
                    switch ($randomValue1) {
                        case 0: $totalPoints = 2000;
                            echo "<h1>Jackpot!</h1>";
                            break;
                        case 1: $totalPoints = 1500;
                            break;
                        case 2: $totalPoints = 1000;
                            break;
                        case 3: $totalPoints = 500;
                            break;
                        case 4: $totalPoints = 250;
                            break;
                    }
                    echo "<h2>You won $totalPoints points!</h2>";
                } else {
                    echo "<h3> Try Again! </h3>";
                }
                echo "</div>";
            }
            for($i = 1; $i<4; $i++) {
                ${"randomValue" . $i } = rand (0,2);
                displaySymbol(${"randomValue"} . $i);
            }
            displayPoints($randomValue1, $randomValue2, $randomValue3);
            echo "<br/><hr> Values: $randomValue1 $randomValue2 $randomValue3";
            // for($i = 0; $i < 3; $i++){
            //    displaySymbol();
            // }
        
        
        ?>
<!--
        <img src="img/lemon.png" width ="70" alt = "Lemon" title = "Lemon"/>
        <img src="img/cherry.png" width ="70" alt = "Cherry" title = "Cherry"/>
        <img src="img/orange.png" width ="70" alt = "Orange" title = "Orange"/>
-->
    </body>
</html>