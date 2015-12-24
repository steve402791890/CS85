<?php
  include "superHTMLDefa.php";
  
  if ( !filter_has_var(INPUT_POST, "user") ) {                    
      $p = new SuperHTML("Hobby SuperHTML -- Form");
      $p->buildTop("This is the new hobby form");
      $p->startForm("hobbySuperHTML.php", "POST");
      $p->h1($p->label("Your Name: ").$p->textbox('user', "") );
      $p->h1($p->label("Email Address: ").$p->textbox('email', "") );
      $p->h1($p->label("Your Hobby: ").$p->textbox('hobby', "") );
      $p->submit("Submit");
      $p->endForm();
      $p->buildBottom();
      print $p->getPage();
      
      } else {                                                    
      
      $q = new SuperHTML("Thank you for using this form");
      $q->buildTop("Here is your input");
      $q->h1("Hello, $user!");
      $q->h1("Your email address as: $email," );
      $q->h1("and your favorite hobby is: $hobby." );
      $q->buildBottom();
      print $q->getPage();
     }
?>