<?php

 $cards = array("ace","one", 2);
 //print_r($cards); //for debugging purposes, shows all elements in array

 //echo $cards[0];
 
 $cards[] = "jack"; //adds new element at the end of the array
 array_push($cards, "queen", "king");
 
 $cards[2] = "ten";

 //print_r($cards); 
 
 //displayCard($cards[3]);
 
 print_r($cards);
 echo "<hr>";
 $lastCard = array_pop($cards); //retrieves and REMOVE the last item in the array
 displayCard($lastCard);
 echo "<hr>";
 print_r($cards);
 
 unset($cards[1]); //removes element from array
 echo "<hr>";
 print_r($cards);
 
 $cards = array_values($cards); //re-indexes array
 echo "<hr>";
 print_r($cards);
 
 shuffle($cards);
 echo "<hr>";
 print_r($cards);
  echo "<hr>";
 $randomIndex = rand(0,count($cards)-1); //getting a random index
 displayCard($cards[$randomIndex]);
 echo "<hr>";
 $randomIndex = array_rand($cards); //getting a random index too
 displayCard($cards[$randomIndex]);
  
 function displayCard($card) {
     
    // global $cards; //using variable that is outside of the function
    // echo "<img src='../challenges/challenge2/img/cards/clubs/$cards[2].png' />";

    echo "<img src='../challenges/challenge2/img/cards/clubs/$card.png' />";

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