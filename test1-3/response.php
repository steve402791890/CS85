<!DOCTYPE html> 
   <head>
      <title>Test1-3</title>
   </head>
   <body> 
       <?php
			$username = filter_input(INPUT_POST, "username");
			$verify = filter_input(INPUT_POST, "verify");
			$id = filter_input(INPUT_POST, "id");
			$room = filter_input(INPUT_POST, "room");
			$os = filter_input(INPUT_POST, "os");
      
			if (filter_has_var(INPUT_POST, "username")){
				print confirmInput();
				if ($verify == 'Yes' ) {                   
					  print "<h1>Thank you for verifying your information.</h1>";
				} else {                         
					  createForm();                                
				}
			}else{
				createForm();
			}
              
			
         
			function createForm() {                       
              echo <<<HERE
                  <h1>Please submit the following information:<br/>
					<form name='myForm' method='post' action='response.php' > 
					Name: <input type="text" name="username" size="25" maxlength="25"/> <br/>
					Employee ID: <input type="text" name="id" size="10" maxlength="10"/> <br/>
					Office Room Number: <input type="text" name="room" size="5" maxlength="5"/> <br/>
					Operating System on the Office Computer: <input type="text" name="os" size="5" maxlength="5"/>
						<button type='submit' value='Submit'>Submit</button> 
					</form>   
HERE;
            }
            
			function confirmInput() {
				global $username;
				global $id;
				global $room;
				global $os;
				echo <<<HERE
					  <h1>Hi $username,<br/>
					  Your empolyee ID is $id, your office is room $room, and your OS is $os.<br/>
					  <br/>
					  if this is correct, click 'Yes.' Otherwise, click 'No.'<br/><br/>
					  <form name='myForm2' method='post' action='response.php'>
						<button type='submit' name=verify value=Yes>Yes</button>
						<button type='submit' name=verify value=No >No</button><br/>
					  </form>
HERE;
            }
      ?>
   </body>
</html>  