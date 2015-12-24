<?php

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = 'root';

$conn  = mysql_connect($mysql_host,$mysql_user,$mysql_password);
mysql_select_db("testphp", $conn);

$sql = "CREATE DATABASE newtest";
$result = mysql_query($sql, $conn) or die(mysql_error());

echo "done";



?>