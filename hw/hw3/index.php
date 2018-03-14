<?php
    include 'inc/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Spanish Quiz! </title>
        <meta charset = "utf-8" />
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id = "header">
            <img id="maracas" src="img/maracas.png" alt="Maracas Logo" />
            <h1 id = title> Spanish Quiz! </h1>
        </div>
        <form id = "quiz_form">
            <label for="name">Name:</label>
            <span class="error">* <?php echo $name_error;?></span>
            <input id="name" type="text" placeholder="Enter Name" name="name" value = "<?php echo $_GET['name']; ?>">
            
            <br /><br />
            <hr>
            <label for="Question1">1) How do you say 'Hello'?</label>
            <span class="error">* <?php echo $q1Message;?></span>
            <br /><br />
            <input id="q1Answers" type="text" placeholder="Enter Answer" name="q1Answers" value = "<?php echo $_GET['q1Answers']; ?>">
            
            <br /><br />
            <hr>
            <label for="Question2">2) Check all the words that are colors.</label> 
            <span class="error">* <?php echo $q2Message;?></span>
            <br /><br />
            <input id="rojo" type="checkbox" name="q2Answers[]" value="rojo" <?php if(in_array('rojo',$_GET['q2Answers'])){echo ' checked="checked"';}?>>
            <label for="rojo">Rojo</label><br>
            <input id="verde" type="checkbox" name="q2Answers[]" value="verde" <?php if(in_array('verde',$_GET['q2Answers'])){echo ' checked="checked"';}?>>
            <label for="verde">Verde</label><br>
            <input id="azul" type="checkbox" name="q2Answers[]" value="azul" <?php if(in_array('azul',$_GET['q2Answers'])){echo ' checked="checked"';}?>>
            <label for="azul">Azul</label><br>
            <input id="oso" type="checkbox" name="q2Answers[]" value="oso" <?php if(in_array('oso',$_GET['q2Answers'])){echo ' checked="checked"';}?>>
            <label for="oso">Oso</label>
            <br /><br />
            <hr>
            <label for="Question3">3) Which word means 'food'?</label>
            <span class="error">* <?php echo $q3Message;?></span>
            <br /><br />
            <input id="cena" type="radio" name="q3Answers" value="cena" <?= ($_GET['q3Answers']=="cena")?"checked":"" ?>>
            <label for="cena">La cena</label><br>
            <input id="desayuno" type="radio" name="q3Answers" value="desayuno" <?= ($_GET['q3Answers']=="desayuno")?"checked":"" ?>>
            <label for="desayuno">El desayuno</label><br>
            <input id="almuerzo" type="radio" name="q3Answers" value="almuerzo" <?= ($_GET['q3Answers']=="almuerzo")?"checked":"" ?>>
            <label for="almuerzo">El almuerzo</label><br>
            <input id="comida" type="radio" name="q3Answers" value="comida" <?= ($_GET['q3Answers']=="comida")?"checked":"" ?>>
            <label for="comida">La comida</label><br>
            <br /><br />
            <hr>
            <label for="Question4">4) Fill in the blank.</label>
            <span class="error">* <?php echo $q4Message;?></span>
            <br /><br />
            <label for="Question4sentece">¿ 
            <select id="Question4" name="q4Answers">
            <option value="1" <?=checkQuestion4("1")?>>-</option>
            <option value="2" <?=checkQuestion4("2")?>>Cómo</option>
            <option value="3" <?=checkQuestion4("3")?>>Cuánto</option>
            <option value="4" <?=checkQuestion4("4")?>>Cuándo</option>
            <option value="5" <?=checkQuestion4("5")?>>Cuánta</option>
            </select>
            cuesta? </label>
            <br /><br />
            <hr>
            <label for="Question5">5) What animal is in the picture?</label>
            <span class="error">* <?php echo $q5Message;?></span>
            <br /><br />
            <img id="elephant" src="img/elephant.jpg" alt="elephant"/>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <input id="perro" type="radio" name="q5Answers" value="perro" <?= ($_GET['q5Answers']=="perro")?"checked":"" ?>>
            <label for="perro">El perro</label><br>
            <input id="gato" type="radio" name="q5Answers" value="gato" <?= ($_GET['q5Answers']=="gato")?"checked":"" ?>>
            <label for="gato">El gato</label><br>
            <input id="tigre" type="radio" name="q5Answers" value="tigre" <?= ($_GET['q5Answers']=="tigre")?"checked":"" ?>>
            <label for="tigre">El tigre</label><br>
            <input id="elefante" type="radio" name="q5Answers" value="elefante" <?= ($_GET['q5Answers']=="elefante")?"checked":"" ?>>
            <label for="elefante">El elefante</label><br>
            <br /><br />
            <input type="submit" name="submit" value="Submit">
            <br /><br />
            <hr>
        </form>
        <?php display()?>
        <footer>
            <strong>CST336 Internet Programming. By: Eli A. Manzo</strong><br />
            <strong>This quiz is not a complete test of your Spanish knowledge.</strong>
            <br />
            <img id="logo" src="img/csumb_logo.png" alt="CSUMB Logo" />
        </footer>
    </body>
</html>