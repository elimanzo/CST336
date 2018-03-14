<?php
    session_start();
    if(isset($_GET['submit'])) {
        $empty = false;
        $name_error = "";
        $correct = "Correct!";
        
        
        for($i = 1; $i <= 5; ++$i) 
            ${"q" . $i . "Message"} = "";
            
        if(empty($_GET['name']) || empty($_GET['q1Answers']) || 
        empty($_GET['q2Answers']) || empty($_GET['q3Answers']) ||
        empty($_GET['q4Answers']) || empty($_GET['q5Answers'])) {
            $empty = true;
        }   
        if(empty($_GET['name'])) {
            $name_error = "You must enter a name.";
        }
        if(empty($_GET['q1Answers'])) {
            $q1Message = "Answers can not be left blank!";
        }
        if(empty($_GET['q2Answers'])) {
            $q2Message = "You must select atleast one answer!";
        }
        if(empty($_GET['q3Answers'])) {
            $q3Message = "You must pick an answer!";
        }
        if(empty($_GET['q4Answers'])  || $_GET['q4Answers'] == '1') {
            $q4Message = "You must pick an answer!";
        }
        if(empty($_GET['q5Answers'])) {
            $q5Message = "You must select an answer!";
        }
        if(!$empty && $_GET['q4Answers'] != '1') {
            $_SESSION['counter']++;
            $total_points = 5;
            for($i = 1; $i <= 5; ++$i) 
                ${"q" . $i . "Message"} = $correct;
            
            if(strtolower($_GET['q1Answers']) != 'hola') {
                $q1Message = "Incorrect Answer. The answer was 'hola'.";
                --$total_points;
            } 
            $question_2_counter = 0;
            foreach ($_GET['q2Answers'] as $answers){ 
                if($answers == 'rojo') {
                    $question_2_counter++;
                }
                if($answers == 'verde') {
                    $question_2_counter++;
                }
                if($answers == 'azul') {
                    $question_2_counter++;
                }
            }
            if ($question_2_counter != 3) {
                $q2Message = "Incorrect Answer. The answer was 'Rojo', 'Azul', and 'Verde'.";
                --$total_points;
            } 
            if($_GET['q3Answers'] != 'comida') {
                $q3Message = "Incorrect Answer. The answer was 'comida'.";
                --$total_points;
            }
            if($_GET['q4Answers'] != 3) {
                $q4Message = "Incorrect Answer. The answer was 'Cuánto'.";
                --$total_points;
            }
            if($_GET['q5Answers'] != 'elefante') {
                $q5Message = "Incorrect Answer. The answer was 'elefante'.";
                --$total_points;
            }
        }
    }

 function checkQuestion4($answer){
   
    if ($answer == $_GET['q4Answers']) {
       echo " selected";
    }
 }
    

function display_score($total_points) {
    $score = ($total_points / 5) * 100;
    $letter_grade;
    
    if($score >= 90) {
        $letter_grade = 'A';
    } else if($score >= 80 && $score < 90) {
        $letter_grade = 'B';
    } else if ($score >= 70 && $score < 80) {
        $letter_grade = 'C';
    } else if ($score >= 60 && $score < 70) {
        $letter_grade = 'D';
    } else {
        $letter_grade = 'F';
    }
    echo "<div id='grade'>";
    echo "<h3>Hey ".$_GET['name']."!</h3>";
    echo "<p>You've taken this quiz " . $_SESSION['counter'] .  " times!</p>";
    echo "<p>Your score was a $score% which is a $letter_grade.</p>";
    echo "<p>Hopefully you found this quiz useful and get a better understaning of Spanish.</p>";
    echo "<p>Feel free to retake the quiz at anytime!</p>";
    echo "</div>";
} 

function display() {
    global $empty;
    global $total_points;
    if(isset($_GET['submit'])) {
        if(!$empty && $_GET['q4Answers'] != '1') {
            display_score($total_points);
        }
        
    }
}
      

?>