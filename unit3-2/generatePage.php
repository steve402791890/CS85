<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<?php
	$title = filter_input(INPUT_GET, "title");
	$head = filter_input(INPUT_GET, "title");
	$bgcolor = filter_input(INPUT_GET, "bgcolor");
	$textcolor = filter_input(INPUT_GET, "textcolor");
	$text = filter_input(INPUT_GET, "text");
	print <<<HERE
              <head>
              <link rel="stylesheet" type="text/css" href="styles.css">
                 <title>$title</title>
                 <style>
                 body {background-color:$bgcolor}
                 h1 {color:$textcolor; font-family:Ariel; font-size:24pt; font-weight:bold}
                 p  {color:$textcolor; font-family:Ariel; font-size:14pt; font-weight:normal}
               </style>
            </head>
            <body>
            	<h1>$head</h1>
                 <p>$text</p>
            </body> 
HERE;
	?>
</html>
