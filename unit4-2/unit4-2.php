<!DOCTYPE html>
<html>
   <head>
      <title>unit4-2</title>   
   </head>
   <body>
   	<?php
           $rank = array('2', '3', '4', '5', '6', '7', '8', '9', 't', 'j', 'q', 'k', 'a'); 
           $suit = array('c', 'd', 'h', 's');                                                 
           $deck = array(52);                                                                
           $hand = array(5);                                                                
            
           createDeck();    
           dealCards();    
           printHand();    
       
         function createDeck() {
           global $deck;
           global $rank;
           global $suit;
           
             $this_card = 0;    
        
            for ($this_suit= 0; $this_suit < count($suit); $this_suit++) {        
              for ($this_rank=0; $this_rank < count($rank); $this_rank++) {    
                     $deck[$this_card] = $rank[$this_rank].$suit[$this_suit];    
                     $this_card++;                                                
                     }
                 }
             }
             
         function dealCards() {
           global $deck;
           global $hand;
           
             for ($i = 0; $i < 5; $i++) {
                 $index = rand(0, count($deck) - 1);
                 $hand[$i] = $deck[$index];     
                 array_splice($deck, $index, 1);    
                 
               } 
           }
         
         function printHand() {
           global $hand;
             
           print <<<HERE
           <form action='' method='post' >
           <h1>This is the five cards in your hand</h1>
           <table class='center'><tr>
HERE;
        foreach ($hand as $card) {        
            echo "<td><img src = '".$card.".gif' /></td>";
            }
        echo "</tr></table>";
        echo "<button type='submit' value='Submit'>Again</button><br/>";
        } 
        
      ?>
   </body>
</html> 