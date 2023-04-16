<?php

// Define a function to get the card balance
function get_card_balance($card_number) {
//   // Connect to the database
//   $conn = mysqli_connect('localhost', 'username', 'password', 'database');
// Connect to the database
define('DB_SERVER', 'mysql://root:1dN7r3mU2jkyJznmRxWJ@containers-us-west-2.railway.app:8042/railway');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '1dN7r3mU2jkyJznmRxWJ');
define('DB_NAME', 'railway');

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Prepare a SQL statement to retrieve the balance
  $stmt = mysqli_prepare($conn, 'SELECT card_amount FROM customers WHERE card_number = ?');
  mysqli_stmt_bind_param($stmt, 's', $card_number);

  // Execute the statement and fetch the result
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $balance);
  mysqli_stmt_fetch($stmt);

  // Close the statement and connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  // Return the balance as a float
  return floatval($balance);
}

// Define a function to post data to the sales table
function post_card_sales($card_number, $amount, $price, $customer_id) {
  // Connect to the database
define('DB_SERVER', 'mysql://root:1dN7r3mU2jkyJznmRxWJ@containers-us-west-2.railway.app:8042/railway');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '1dN7r3mU2jkyJznmRxWJ');
define('DB_NAME', 'railway');

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Prepare a SQL statement to insert the data
  $stmt = mysqli_prepare($conn, 'INSERT INTO sales (card_number, machine_id, item, price, customer_id) VALUES (?, ?, ?, ?, ?)');
  mysqli_stmt_bind_param($stmt, 'sd', $card_number, $amount, $price, $customer_id);

  // Execute the statement
  mysqli_stmt_execute($stmt);

  // Close the statement and connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

// Define a function to post data to the sales table
function post_coin_sales($card_number, $amount, $price, $customer_id) {
    // Connect to the database
  define('DB_SERVER', 'mysql://root:1dN7r3mU2jkyJznmRxWJ@containers-us-west-2.railway.app:8042/railway');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '1dN7r3mU2jkyJznmRxWJ');
  define('DB_NAME', 'railway');
  
  /* Attempt to connect to MySQL database */
  $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  
    // Prepare a SQL statement to insert the data
    $stmt = mysqli_prepare($conn, 'INSERT INTO sales (card_number, machine_id, item, price, customer_id) VALUES (?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sd', $card_number, $amount, $price, $customer_id);
  
    // Execute the statement
    mysqli_stmt_execute($stmt);
  
    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }

// /// Usage example
// $card_number = '1234567890123456';
// $balance = get_card_balance($card_number);
// if ($balance >= 10.0) {
//   post_sales_data($card_number, 10.0);
//   echo "Sale successful!";
// } else {
//   echo "Insufficient balance.";
// }
