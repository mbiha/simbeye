
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tea and Coffee Vending Machine</title>
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">Tea and Coffee Vending Machine</a>
<!--     <a class="btn btn-outline-secondary my-sm-0" href="purchases.php">History</a> -->
    
  </nav>
  <div class="container-fluid">
    <div class="card text-center">
      <div class="card-body">
        <?php
// Include config file
require_once "../includes/db.php";

$card_number = $_GET['card_number'];

// Attempt select query execution
$sql = "SELECT machine_id, item, price, time FROM sales WHERE customer_id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
  mysqli_stmt_bind_param($stmt, "s", $card_number);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if (mysqli_num_rows($result) > 0) {
    echo '<table class="table table-hover" id="transactions_table">';
    echo "<thead>";
    echo "<tr>";
    echo "<th>Machine ID</th>";
    echo "<th>Date</th>";
    echo "<th>Item</th>";
    echo "<th>Price</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['machine_id'] . "</td>";
      echo "<td>" . $row['time'] . "</td>";
      echo "<td>" . $row['item'] . "</td>";
      echo "<td>" . $row['price'] . "</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    // Free result set
    mysqli_free_result($result);
  } else {
    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
  }
} else {
  echo "Oops! Something went wrong. Please try again later.";
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($link);
?>
        
         
        
      </div>
    </div>
    <!-- <div class="card-footer text-muted">2 days ago</div> -->
  </div>
  </div>
</body>




