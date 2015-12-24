<?php 

//connect to the MySQL server as the user and select the username_project database 
$conn = mysqli_connect("localhost", "nyang", "FHpwj3LTUO", "nyang_project") or die(mysqli_error());  

// query the database 
$result = mysqli_query($conn, 'DROP TABLE IF EXISTS yang_ning_elves') or die(mysqli_error());  

//create another query  
$query = 'CREATE TABLE yang_ning_elves (id int NOT NULL AUTO_INCREMENT PRIMARY KEY)'; 

// send the query 
$result = mysqli_query($conn, $query) or die(mysqli_error());  

// give user warm and fuzzy feeling 
echo 'All queries ran successfully.'; 
?> 