<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SaveSonnet</title>
</head>
<body>
<?php
$Fname = $_POST["Fname"];
$Lname = $_POST["Lname"];
$gender = $_POST["gender"];
$food = $_POST["food"];
$quote = $_POST["quote"];
$education = $_POST["education"];
$TofD = $_POST["TofD"];
if (!isset($_POST['submit'])) { // if page is not submitted to itself echo the form

<html>
<head>
<title>Personal INFO</title>
</head>
<body>
<form method="post" action="<?php echo $PHP_SELF;?>">
<fieldset>
    <legend>Personal information:</legend>
    First name:
    <input type="text" name="firstname" value="Mickey">
    
    Last name:
    <input type="text" name="lastname" value="Mouse">
    <br>
    
    <br>
   <textarea rows="4" cols="50">
   Your special message to the host.
   </textarea>
    <input type="submit" value="Submit">
  </fieldset>
</form>
}
?>
</body>
</html>