<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Row Your Boat</title>
</head>
<body>
<h1>Row Your Boat</h1>
<h3>Demonstrates use of long variables</h3>

<?php 

$verse = <<<HERE

<p>
Row, Row, Row, your boat<br />
Gently Down the stream<br />
Merrily, Merrily, Merrily, Merrily<br />
Life is but a dream!<br />
</p>
HERE;

print "<h3>Verse 1:</h3>";
print $verse;

print "<h3>Verse 2:</h3>";
print $verse;
print "<h3>Verse 3:</h3>";
print $verse;

?>


</body>
</html>