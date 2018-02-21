<?php


function createPass() {
    $size = rand(5, 10);
    $digits = rand(1,3);
    $random_letter = rand(97,127);
    $pass_arr = array("");
    $num_letters;
    $num_digits;
    $digit_counter = 0;
    $letter_string;
    
    
    
    for($i = 0; $i < $size; ++$i) {
        
        $num_letters = rand(1,2);
        if($num_letters == 1 && digit_counter != 3) {
            array_push($pass_arr, chr(rand(97,122)));
            $digit_counter++;
            
        } else {
          array_push($pass_arr, chr(rand(48,57))); 
        }
    }
    print_r($pass_arr);
}
    
function makePass() {
    echo '
<table>
  <tr>
    <td>Customer Name</td>
    <td>', $var1, '</td>
  </tr> ' 
    for($i = 0; $i < 25; ++$i) {
        createPass();
    }
}    
    
 

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Challenge 3</title>
    </head>
    <body>
        <?php
            makePass();
        ?>
    </body>
</html>