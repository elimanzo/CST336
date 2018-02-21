<?php
    function displaySymbol($randomValue, $symbol) {
     
        echo "<img id='reel$randomValue' src='img/$symbol.png' width ='70' alt = '$symbol' title = '". ucfirst($symbol) ."'>";        
    }
    
    function checkX($board) {
        return ($board[0] == 'x' &&  $board[1] == 'x' && $board[2] == 'x') || // row 1 check
               ($board[3] == 'x' &&  $board[4] == 'x' && $board[5] == 'x') || // row 2 check
               ($board[6] == 'x' &&  $board[7] == 'x' && $board[8] == 'x') || // row 3 check
               ($board[0] == 'x' &&  $board[3] == 'x' && $board[6] == 'x') || // col 1 check
               ($board[1] == 'x' &&  $board[4] == 'x' && $board[7] == 'x') || // col 2 check
               ($board[2] == 'x' &&  $board[5] == 'x' && $board[8] == 'x') || // col 3 check
               ($board[0] == 'x' &&  $board[4] == 'x' && $board[8] == 'x') || // diagonal 1 check
               ($board[2] == 'x' &&  $board[4] == 'x' && $board[6] == 'x'); // diagonal 2 check
    }
    
    function checkO($board) {
        return ($board[0] == 'o' &&  $board[1] == 'o' && $board[2] == 'o') || // row 1 check
               ($board[3] == 'o' &&  $board[4] == 'o' && $board[5] == 'o') || // row 2 check
               ($board[6] == 'o' &&  $board[7] == 'o' && $board[8] == 'o') || // row 3 check
               ($board[0] == 'o' &&  $board[3] == 'o' && $board[6] == 'o') || // col 1 check
               ($board[1] == 'o' &&  $board[4] == 'o' && $board[7] == 'o') || // col 2 check
               ($board[2] == 'o' &&  $board[5] == 'o' && $board[8] == 'o') || // col 3 check
               ($board[0] == 'o' &&  $board[4] == 'o' && $board[8] == 'o') || // diagonal 1 check
               ($board[2] == 'o' &&  $board[4] == 'o' && $board[6] == 'o'); // diagonal 2 check
    }
    
    function displayWin($symbol) {
        echo "<div id='output'>";
        if($symbol == 'x') {
            echo "<h1>You won! ". ucfirst($symbol) ."  wins the game!</h2>";
        } else if ($symbol == 'o'){
            echo "<h2>You lost. ". ucfirst($symbol) ."  wins the game!</h3>";
        } else if ($symbol == ' ') {
            echo "<h2>Tie game!</h2>";
        }
            echo "</div>";
    }
    
    function play() {
        $board = array();
        
        //initialize board
        for($i = 0; $i<9; $i++) {
            array_push($board, ' ');
        }
        
        $turns;
        $tie_counter = 0;
        $randomValue = rand(0,count($board));
        for($i = 0; $i<count($board); $i++) {
            if ($i % 2 == 0) {
                $turns = 'x';
            } else { 
                $turns = 'o';
            }
            
            while ($board[$randomValue] != ' ') {
                $randomValue =  array_rand($board);
            }
            $board[$randomValue] = $turns;
            displaySymbol($randomValue, $turns);
            if (checkX($board)) {
                displayWin('x');
                $tie_counter++;
                break;
            } 
            if (checkO($board)) {
                displayWin('o');
                $tie_counter++;
                break;
            } 
            if ($tie_counter == 0 && $i == count($board) - 1) {
                displayWin(' ');
            }
        }
    }
?>