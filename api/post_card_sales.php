<?php

// Include the API file that contains the post_sales_data() function
require_once('api.php');

// Define the endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['card_number']) && isset($_GET['amount']) && isset($_GET['item']) && isset($_GET['machine_id'])) {
  $customer_id = $_GET['card_number'];
  $amount = $_GET['amount'];
  $machine_id = $_GET['machine_id'];
  $item = $_GET['item'];


    if($customer_id != null){
        post_card_sales($machine_id, $item,  $amount, $customer_id);
        echo "success";
        reduce_card_balance($customer_id);
    }
    else{
        post_coin_sales($machine_id, $item,  $amount);
        echo "success";
    }
    
 

} else {
  header('HTTP/1.1 400 Bad Request');
  echo "Invalid request.";
}
