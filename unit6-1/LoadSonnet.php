<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>LoadSonnet</title>
<style type = "text/css">
body{
  background-color:black;
  color: white;
  font-family: 'Brush Script MT', script;
  font-size: 1.5em;
  text-align: center;
}
</style>

</head>
<body>
<div>
<?php 
$fp = fopen("sonnet76.txt", "r");

//first line is title
$line = fgets($fp);
print "<h1>$line</h1>\n";

//print rest of sonnet
while (!feof($fp)){
  $line = fgets($fp);
  print "$line <br />\n";
} // end while

fclose($fp);

?>
</div>
</body>
</html>