<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<head>
			<meta charset="utf-8" />
			<title>DieRoller</title>
			<link rel="stylesheet" type="text/css" href="styles.css">
		</head>
		<body>
			<h1>Roll Dies</h1>

			<?php
			rollDies();
			printForm();

			function printForm() {
				global $sides;
				print <<<HERE
		  <form name='rollEmm' action='' method='post'>
		  <table border="50" align="center">
		<tr>
		  <td width="299">Please input how many die sides you want</td>
		  <td width="38">
		  <fieldset>
			<h2>Sides: <input type='text' name='sides' size='3' maxlength='3' value='?' /></h2>
			<input type='submit' value='submit'>
		</fieldset></td>
		</form>

HERE;

			}

			function rollDies() {
				global $sides;
				$sides = filter_input(INPUT_POST, "sides");
				if (!filter_has_var(INPUT_POST, "sides")) {// first time through (ask for # of sides)
					print "<h1>How many sides would you like on the die?</h1>";
				} else {// roll die with stated # of sides
					if ($sides == 0 || $sides == 1) {
						print "<h1>That is an Escherian die! Please try again.</h1>";
					} elseif ($sides > 0 && $sides < 7) {
						$roll = rand(1, $sides);
						print "<h1>You rolled a <span style='color:green'>$roll</span> on a die with $sides sides.</h1>";
						print <<< HERE
			
			<p>
				<IMG class = "displayed" src = "die$roll.jpg" alt = "die: $roll" />
			</p>

HERE;
					} else {
						$roll = rand(1, $sides);
						print "<h1>You rolled a <span style='color:red'>$roll</span> on a die with $sides sides.</h1>";

					}
				}
			}
			?>
		</body>
</html>