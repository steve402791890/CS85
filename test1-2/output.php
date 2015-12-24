<!DOCTYPE html> 
   <head>
      <title>Test1-2</title>
   </head>
   <body> 
      <?php
		$email = "fred@carpets.com";
		$text = <<<HERE
		"This is a really long 'string' </br>
		that covers several 'lines'and has </br>
		an embedded variable $email that prints </br>
		a email address and both single </br>
		and double quotes."
		
HERE;
        print $text;
      ?>
   </body>
</html>  