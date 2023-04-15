<?php

// Include the API file that contains the post_sales_data() function
require_once('card_api.php');

// Define the endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['card_number']) && isset($_GET['amount']) && isset($_GET['item']) && isset($_GET['machine_id'])) {
  $card_number = $_GET['card_number'];
  $amount = floatval($_GET['amount']);
  $machine_id = intval($_GET['machine_id']);
  $item = $_GET['item'];

  if($card_number != null){
    post_card_sales($card_number, $amount, $machine_id, $item);
    echo "Sale successful!";
  }
  else{
    post_coin_sales($card_number, $amount, $machine_id, $item);
    echo "Sale successful!";
  }
  

} else {
  header('HTTP/1.1 400 Bad Request');
  echo "Invalid request.";
}