<?php

$cards = array("ace", "one", 2);
//print_r($cards); // for debuffing purposes shows all elements in array
echo $cards[0];

$cards[] = "jack"; // adds new element at the end of the array

array_push($cards, "queen", "king");

$cards[2] = "ten";

print_r($cards);

displayCard($cards[3]);

function displayCard($cards) {
    echo "<img src= '../Challenge/Challenge2/img/cards/clubs/$cards.png' width ='70' alt = \"". 
        ucfirst($cards) ."\" title = \"". ucfirst($cards) ."\"/>";
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>