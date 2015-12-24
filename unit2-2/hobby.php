<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Hi User</title>
	</head>
	<body>
		<h1>Hi User</h1>
		<h3>PHP program that receives a value from "whatsName"</h3>

		<?php
		$userName = filter_input(INPUT_GET, "userName");
		$email = filter_input(INPUT_GET, "email");
		$hobby = filter_input(INPUT_GET, "hobby");

		print "<h2> Your username is $userName</h2></br>";
		print "<h2> Your email is $email</h2></br>";
		print "<h2> Your hobby is $hobby</h2></br>";
		
		?>
	</body>
</html>
