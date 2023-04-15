<?php

$dbname = 'vending_machine';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$connect = @mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$connect){echo "Error: " . mysqli_connect_error(); exit();}

$machine_id = $_GET["machine_id"];
$location= $_GET["location"]; 

$query = "INSERT INTO machine (machine_id, location) VALUES ('$machine_id', '$location')";
$result = mysqli_query($connect,$query);

?>