<?php
// Include config file
require_once "../includes/db.php";

// Get card number from GET parameter
$card_number = $_GET['card_number'];

// Attempt select query execution
$sql = "SELECT machine_id, item, price, time FROM sales WHERE card_number = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
  mysqli_stmt_bind_param($stmt, "s", $card_number);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if (mysqli_num_rows($result) > 0) {
    echo '<table class="table table-hover" id="transactions_table">';
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
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
