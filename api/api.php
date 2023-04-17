<?php
// Connect to the database
define('DB_SERVER', 'containers-us-west-2.railway.app:8042');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '1dN7r3mU2jkyJznmRxWJ');
define('DB_NAME', 'railway');

// Define a function to get the card balance
function get_card_balance($card_number) {
//   // Connect to the database
//   $conn = mysqli_connect('localhost', 'username', 'password', 'database');


/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Prepare a SQL statement to retrieve the balance
  $stmt = mysqli_prepare($conn, 'SELECT card_amount FROM customer WHERE card_number = ?');
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

function post_card_sales($machine_id, $item, $amount, $customer_id) {
  // Connect to the database
  define('DB_SERVER', 'containers-us-west-2.railway.app:8042');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '1dN7r3mU2jkyJznmRxWJ');
define('DB_NAME', 'railway');

  /* Attempt to connect to MySQL database */
  $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare a SQL statement to insert the data
  $stmt = mysqli_prepare($conn, 'INSERT INTO sales (machine_id, item, price, customer_id) VALUES (?, ?, ?, ?)');
  if (!$stmt) {
    die("Error: " . mysqli_error($conn));
  }

  // Bind the parameters to the statement
  mysqli_stmt_bind_param($stmt, 'ssds', $machine_id, $item, $amount, $customer_id);

  // Execute the statement
  if (!mysqli_stmt_execute($stmt)) {
    die("Error: " . mysqli_stmt_error($stmt));
  }

  // Close the statement and connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}


// Define a function to post data to the sales table
function post_coin_sales($machine_id, $item, $amount) {
  // Connect to the database
  define('DB_SERVER', 'containers-us-west-2.railway.app:8042');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '1dN7r3mU2jkyJznmRxWJ');
define('DB_NAME', 'railway');
  
  /* Attempt to connect to MySQL database */
  $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare a SQL statement to insert the data
  $stmt = mysqli_prepare($conn, 'INSERT INTO sales (machine_id, item, price) VALUES (?, ?, ?)');
  mysqli_stmt_bind_param($stmt, 'ssd', $machine_id, $item,  $amount);

  // Execute the statement
  if (!mysqli_stmt_execute($stmt)) {
    die("Error: " . mysqli_stmt_error($stmt));
  }

  // Close the statement and connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

function reduce_card_balance($card_id) {
  /* Attempt to connect to MySQL database */
  $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $balance = get_card_balance($card_number);
  if($balance>500){
  $balance = $balance - 500;
   // Prepare a SQL statement to insert the data
  $stmt = mysqli_prepare($conn, 'INSERT INTO customer (card_amount) VALUES (?)  WHERE card_id = $card_id');
  }
  if (!$stmt) {
    die("Error: " . mysqli_error($conn));
  }

  // Bind the parameters to the statement
  mysqli_stmt_bind_param($stmt, 'ssds', $balance);

  // Execute the statement
  if (!mysqli_stmt_execute($stmt)) {
    die("Error: " . mysqli_stmt_error($stmt));
  }

  // Close the statement and connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
