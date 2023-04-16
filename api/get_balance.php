<?php

// Include the API file that contains the get_card_balance() function
require_once('api.php');

// Define the endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['card_number'])) {
  $card_number = $_GET['card_number'];
  $balance = get_card_balance($card_number);
  //header('Content-Type: application/json');
  echo $balance;
} else {
  header('HTTP/1.1 400 Bad Request');
  echo "Invalid request.";
}
