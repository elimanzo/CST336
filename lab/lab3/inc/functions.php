<?php

function displayCard($player, $cardNumber, $value, $suite) {
    echo "<img id='player$player-$suite-$cardNumber' 
    src='img/cards/$suite/$value.png' 
    width ='90' margin-bottom = '100pt' margin-top = '120pt' alt = 'player$player-$suite-$cardNumber' 
    title = 'Player$player-$suite-$cardNumber)'>"; 
}

function checkWinners($hand0, $hand1, $hand2, $hand3) {
    $winners = array();
    $mostPoints = 0;
    
    for($i = 0; $i < 4; ++$i) {
        if(array_sum(${"hand" . $i}) <= 42 &&  
        array_sum(${"hand" . $i}) > $mostPoints) {
            $mostPoints = array_sum(${"hand" . $i});
        } 
    }
    
    for($i = 0; $i < 4; ++$i) {
        if(array_sum(${"hand" . $i}) == $mostPoints) {
            $winners[] = $i;
        }
    }
    
    return $winners;
}


function calcPoints ($hand0, $hand1, $hand2, $hand3) {
    return array_sum($hand0) + array_sum($hand1) + array_sum($hand2) 
    + array_sum($hand3);
}

function displayWinner($winners, $players, $points) {
    echo"<div id = 'winner'>";
    echo"<h1>";
    if(count($winners) == 0) {
        echo"Nobody Wins";
        echo"</h1>";
        echo"</div>";
        return;
        
    }
    for($i = 0; $i < count($winners); ++$i) {
        $winner = $players[$winners[$i]];
        echo"$winner wins $points points";
        echo"<br/>";
    }
    echo"</h1>";
    echo"</div>";
}


function playCards() {
    echo"<h1 id = 'gameHeading'> Silver Jack Game </h1>";
    session_start();
    $start = microtime(true);
    $_SESSION['counter']++;
    $_SESSION['totalTime'];
    
    
    $players = array("Eli", "Bianca", "Juan", "Mustafa");
    
    $hand0 = array();
    $hand1 = array(); 
    $hand2 = array(); 
    $hand3 = array();
    
    $deck = range(0,51);  //creates array with values 1 to 52
    
    $suite = array("clubs","spades","hearts","diamonds");
    
    shuffle($deck);
    shuffle($players);
    
    for($i = 0; $i < count($players); ++$i) {
        $cardNumber = 0;
        echo"
        <h3 id = 'name'><img id='player$player' src='img/players/$players[$i].png'  height='auto' alt = 'player$player' title = 'Player$player)'>$players[$i]:</h3><br>";
        
        while(array_sum(${"hand" . $i}) < 37) {
            ${"hand" . $i}[] = $deck[0] % 13 + 1;
            displayCard($i, $cardNumber, $deck[0] % 13 + 1, $suite[floor($deck[0] / 13)]);
            unset($deck[0]);
            $deck = array_values($deck);
            $cardNumber++;
        }
        
        $current_player_points = array_sum(${"hand" . $i});
        echo"<h3 id = 'score'> Score: $current_player_points</h3>";
        echo"<br/><hr>";
    }
    
    displayWinner(checkWinners($hand0, $hand1, $hand2, $hand3), $players, 
    calcPoints ($hand0, $hand1, $hand2, $hand3));
    
    $elapsedSecs = microtime(true) - $start;
    $_SESSION['totalTime'] += $elapsedSecs;
    echo"<div id = 'timer'>";
    echo "Time Elapses: " . $elapsedSecs . " secs";
    echo"<br/>";
    echo "Average Time Elapses: " . $_SESSION['totalTime'] / $_SESSION['counter'] . " secs";
    echo"<br/>";
    echo"Games played: " . $_SESSION['counter'];  
    echo"</div>";
}
?>