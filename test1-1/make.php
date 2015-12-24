<!DOCTYPE html> 
   <head>
      <title>Test1-1</title>
   </head>
   <body> 
      <?php
		$user = filter_input(INPUT_POST, "name");
		$time_day =filter_input(INPUT_POST, "time_of_the_day");
		$plan = filter_input(INPUT_POST, "plan_of_day");
		print <<<HERE
		  <p>Hi, $user, how are you this $time_day?<br/>
		  </p>
		  <p>Hope you have a wonderful time $plan.
		  </p>
HERE;
       
      ?>
   </body>
</html>  