
<!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css" />
// Get card number from GET parameter

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
