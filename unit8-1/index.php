
<?php 
  //Simple CMS
  //Extremely Simple CMS system
  //Andy Harris for PHP/MySQL Adv. Beg 2nd Ed.
  

  //retrieve variables
  if (filter_has_var(INPUT_GET, "menu")){
    $menu = filter_input(INPUT_GET, "menu");
  } else {
    $menu = "menu.html";
  } // end if

  if (filter_has_var(INPUT_GET, "content")){
    $content = filter_input(INPUT_GET, "content");
  } else {
    $content = "default.html";
  } // end if

  include ("top.html");

  print "<div class = \"menuPanel\"> \n";
  include ($menu);
  print "</div> \n";

  print "<div class = \"item\"> \n";
  include ($content);
  print "</div> \n";

?>
</body>
</html>

