<?php

$dbname = 'vending_machine';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$connect = @mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$connect){echo "Error: " . mysqli_connect_error(); exit();}

$machine_id = $_GET["machine_id"];
$amount_paid= $_GET["amount_paid"]; 

$query = "INSERT INTO payment_item (machine_id, amount_paid) VALUES ('$machine_id', '$amount_paid')";
$result = mysqli_query($connect,$query);

?>