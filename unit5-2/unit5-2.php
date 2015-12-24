<?php session_start() ?>
<!DOCTYPE html>
  <head>
      <title>Unit5-2</title>   
  </head>
  <body>       
   <?php 
          global $world;    
          global $alive;    
          
          
            if ( filter_input(INPUT_GET, "killAll" ) ) {   
              unset( $_SESSION['started'] );
            }
            
          if (isset($_SESSION["started"]) ) {            
              nextGen();
              printResult();
              showWorld();
              } else {                                    
              echo "<h1>Welcome to the game, please enjoy!!!</h1>\n<br/>";
              initializeGame();
              showWorld();
              $_SESSION["started"] = true;
              }

          function initializeGame() {                    
            global $world, $alive, $btnText, $generation;
           
              $alive = true;
              $btnText = "Next Generation...";
              $generation = 0;
              $world = array(
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false),
                  );
              
              $_SESSION["world"] = $world;
              $_SESSION["alive"] = $alive;
              $_SESSION["btnText"] = $btnText;
              $_SESSION["generation"] = $generation;
               }
         
          function nextGen() {                  
         
              global $world;
              $world = $_SESSION["world"];            
              for ($x = 0; $x<25; $x++) {
                  for ($y = 0; $y<30; $y++) {
                      if ( filter_input(INPUT_GET, $x."_".$y ) ) {
                          $world[$x][$y] = true;
                          }
                      }
                  }
              $_SESSION["world"] = $world;           

              $newWorld = $world;                      
              
              for ($x = 0; $x<25; $x++) {              
                  for ($y = 0; $y<30; $y++) {
                      $cw = conway($x, $y);              
                      if ( ($world[$x][$y] == true && $cw < 2) ||            
                                  ($world[$x][$y] == true && $cw > 3) ) {    
                          $newWorld[$x][$y] = false;                        
                          }
                      else if ($world[$x][$y] == false && $cw == 3) {     
                          $newWorld[$x][$y] = true;                        
                          }
                      }
                  }
              $_SESSION["world"] = $newWorld;       
              $_SESSION["generation"]++;           
              }
          
          function conway($xx, $yy) {            
              global $world;                        
              $count = 0;
              
              if ( $xx-1 > -1 ) {
                  if ( $yy-1 > -1 && $world[$xx-1][$yy-1] ) {$count++;}
                  if ( $world[$xx-1][$yy] )  {$count++;}
                  if ( $yy+1 < 30 && $world[$xx-1][$yy+1] )  {$count++;}
                  }
              if ( $yy-1 > -1 && $world[$xx][$yy-1] )  {$count++;}
              if ( $yy+1 > -1 && $world[$xx][$yy+1] )  {$count++;}
              if ( $xx+1 < 25 ) {
                  if ( $yy-1 > -1 && $world[$xx+1][$yy-1] ) {$count++;}
                  if ( $world[$xx+1][$yy] )  {$count++;}
                  if ( $yy+1 < 30 && $world[$xx+1][$yy+1] )  {$count++;}
                  }
              return $count;
              }
              
          function printResult() {                
              global $started;
              global $btnText;
              $btnText = $_SESSION["btnText"];
              $started = $_SESSION["started"];
              
              if ( areAnyAlive() ) {                
                echo "<br/><h1>It is still alive. </h1>\n<br/>";
                } else {
                $btnText = "Again?";
                  $_SESSION["btnText"] = $btnText;
                  unset( $_SESSION['started'] );
                echo "<br/><h1>The end of the world :(</h1>\n<br/>";
                }
            }
            
          function areAnyAlive() {                
            global $world;
              $world = $_SESSION["world"];
              global $generation;
              $generation = $_SESSION["generation"];
              
              for ($x = 0; $x<25; $x++) {
                  for ($y = 0; $y<30; $y++) {
                      if ( $world[$x][$y] ) {
                          return true;            
                          }
                      }
                  }
              return false;                       
            }
          
          function showWorld() {               
              global $world;
              global $btnText;
              global $generation;
              $world = $_SESSION["world"];
              $btnText = $_SESSION["btnText"];
              $generation = $_SESSION["generation"];
              
              echo "<form  id='myForm' method='get' ><table class='center'>";
              for ($x = 0; $x<25; $x++) {
                  echo "<tr>";
                  for ($y = 0; $y<30; $y++) {
                      if ($world[$x][$y] == false) {
                          echo "<input type='checkbox' name='".$x."_".$y."' />";
                          } else {
                          echo "<input type='checkbox' name='".$x."_".$y."' checked='checked' />";
                          }
                      }
                  echo "</tr><br/>";
                  }
              echo "</table><input type='checkbox' name='killAll'  /> Check to clear<br />
                      <input type='submit' value='$btnText' /><br/><br/>Next ".$generation."<br/>";
        
              $_SESSION["world"] = $world;
              $_SESSION["btnText"] = $btnText;
              }      

    ?>  
 </body>
</html>  