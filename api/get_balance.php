<?php

// Include the API file that contains the get_card_balance() function
require_once('card_api.php');

// Define the endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['card_number'])) {
  $card_number = $_GET['card_number'];
  $balance = get_card_balance($card_number);
  $response = array('balance' => $balance);
  header('Content-Type: application/json');
  echo json_encode($response);
} else {
  header('HTTP/1.1 400 Bad Request');
  echo "Invalid request.";
}
?>