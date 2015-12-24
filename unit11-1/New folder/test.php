<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">  
   <head>
      <title>Music Master</title>
      
   </head>
   <body> 
      <?php
        $mysql_host = 'localhost';
		$mysql_user = 'root';
		$mysql_password = 'root';

		$conn  = mysql_connect($mysql_host,$mysql_user,$mysql_password);
		mysql_select_db("testphp", $conn);

		$sql = "CREATE DATABASE platz_brian_artists";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		echo "done";
		
		
		$sql = "SELECT * FROM platz_brian_artists"; 
		

		
        
    
?>
      

   </body>
</html>  