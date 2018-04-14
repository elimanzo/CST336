<?php
    session_start();

    if(!isset($_SESSION['attempts'] )) {
        playAgain();
        resetHistory();
    }
    
    if(isset($_GET['playAgain'])) {
        playAgain();
    }
    
    if(isset($_GET['giveUp'])) {
        echo "<h2>The Answer was: ". $_SESSION[answer] . "</h2>";
        playAgain();
    }
    
    function playAgain() {
        $_SESSION['attempts'] = 0; 
        $_SESSION['answer'] =  rand(1,10);
        $_SESSION['guesses'] = array();
    }
    
    function resetHistory() {
        $_SESSION['history'] = array();
    }
    
    function play() {
        if(isset($_GET['guessNum'])) {
            if(empty($_GET['guess'])) {
                echo "<h1> Error you must fill in a number</h1>";
            } else {
                array_push($_SESSION['guesses'],$_GET['guess'] );
                $_SESSION['attempts']++;
                if ($_SESSION['answer'] > $_SESSION['guess']) {
                    echo "The number should be higher<br />";
                }
    
                if ($_SESSION['answer'] < $_SESSION['guess']) {
                    echo "The number should be lower<br />";
                }
    
                if ($_SESSION['answer'] == $_SESSION['guess']) {
                    echo "CORRECT!<br />";
                    addHistory();
                }
                
            }
        }
    }
    function addHistory() {
        $historyMessage = "<You guessed the numbers ";
        foreach($_SESSION['guesses'] as $guesses){
            $historyMessage .= $guesses . " "; 
        }
        $historyMessage .=  $_SESSION['attempts'] . " attempts<br />";
        array_push($_SESSION['history'], $historyMessage);
    }
    function displayHistory() {
        echo "<h2>Guesses History:</h2>";
        foreach($_SESSION['history'] as $history){
            echo $history;
        }
    }
?>
    

<!DOCTYPE html>
<html>
    <head>
        <title> Guess a Number </title>
    </head>
    <body>
        <h1>Guess a number between 1 and 10</h1>
        <br/>
        <form method = 'get'>
            Guess: <input type="text" name="guess"/><br/>
            <input type="submit" name= "guessNum" value= "Guess Number">
            <input type="submit" name= "playAgain" value= "Play Again">
            <br/><br/>
            <input type="submit" name= "giveUp" value= "Give Up">
        </form>
        <?php
            play();
            if ($_SESSION['attempts'] > 0) {
                echo "Number of Tries: " . $_SESSION['attempts'] ;
            }
        ?>
        <br/><br/>
        <?php if(!empty($_SESSION['history'])) displayHistory(); ?>

    </body>
</html>