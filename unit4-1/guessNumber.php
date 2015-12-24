<!DOCTYPE html>
<html>
   <head>
      <title>unit4-1</title>   
   </head>
   <body> 
         <h1>"This is a number guessing game"</h1>
      <?php

          global $guess, $counter, $randNum;
                
        $guess = filter_input(INPUT_POST, "guess");
        $counter = filter_input(INPUT_POST, "counter");
        $randNum = filter_input(INPUT_POST, "randNum");
      
        if (filter_has_var(INPUT_POST, "guess")){
			continueGame();
		}else{
			startGame();
		}
		function startGame() {
            global $guess, $counter, $randNum;
            $counter = 1;
            $randNum = rand(1, 50); 
			
        print <<<HERE
            <form method='post' action='' name='form'> 
            <h1>I'm thinking of a number between 1 to 50<br/>
            Enter your guess below:  <br/>
			<input type='text' id='guess' name='guess' value='$guess' size='3'/>
            <button type='submit' >Submit</button><br/>
            <input type='hidden' name='counter' value='$counter'><br/>
            <input type='hidden' name='randNum' value='$randNum'></h1>
            </form>
HERE;
      }
            
        function continueGame() {
            global $guess, $counter, $randNum;
         
            $guess = filter_input(INPUT_POST, "guess");            
            $counter = filter_input(INPUT_POST, "counter");      
            $randNum = filter_input(INPUT_POST, "randNum");      
            
            if ($guess == $randNum) {
                ECHO <<<HERE
                    <h1>You are right.This time took you $counter tries!</h1><br/> 
HERE;
            } else { 
                if ($guess < $randNum) {
                    ECHO "<h1>The number you guess is too low, you need to get higher.<br/></h1>";
                    }elseif ($guess > $randNum) {
                    ECHO "<h1>The number you guess is too high, you need to get lower.<br/></h1>";
                    }
                $counter++;
                ECHO <<<HERE
                    <form method='post' name='form'> Try again <br/><input type='text' name='guess' size='3'/>
                    <button type='submit' >Submit</button>
                    <input type='hidden' name='counter' value='$counter'><br/>
                    <input type='hidden' name='randNum' value='$randNum'></h1>
                    </form>
HERE;
            }
      }  
       
      ?>
   </body>
</html>  