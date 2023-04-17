<?php
// Include db file
require_once "../includes/db.php";

$card_number = $result = $balance = "";

// Attempt select query execution
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get POST parameter
  $card_number =  trim($_POST["card_number"]);

  $sql = "SELECT card_amount FROM customer WHERE card_number=?";
  $stmt = $link->prepare($sql);
  // Set parameters
  $param_card_number = $card_number;

  // Bind variables to the prepared statement as parameters
  $stmt->bind_param("s", $param_card_number);


  $stmt->execute();

  $result = $stmt->get_result();

  $row = mysqli_fetch_row($result);

  $balance = $row[0];

  // if (empty($result)) {
  //   echo "<h5>" . $result . "</h5>";
  //   // Free result set
  //   mysqli_free_result($result);
  // } else {
  //   echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
  // }

  // echo "<h5>" . $balance . "</h5>";

  // Close connection 
  mysqli_close($link);
}
?>

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
      <!-- <div class="card-header">Featured</div> -->
      <div class="card-body">
        <h5 class="card-title">Enter Your Card Number</h5>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-group row">
            <div class="col-sm-10 col-lg-3 container">
              <input type="text" class="form-control" name="card_number" placeholder="Example. 8982938576" />
              <div class="form-group">
                <input type="<?php echo empty($balance) ? "hidden" : "text"; ?>" class="form-control" value="<?php echo $balance; ?>" />
              </div>
            </div>
          </div>
          <!-- <a href="purchases.html" class="btn btn-primary">View Balance</a> -->
          <input type="submit" class="btn btn-primary" value="View Balance">
              <form action="purchases.php" method="get">
          <div class="form-group">
          <label for="card-number">Card Number:</label>
          <input type="text" class="form-control" id="card-number" name="card_number">
          </div>
          <button type="submit" class="btn btn-outline-secondary my-sm-0">History</button>
        </form>
        </form>
      </div>
    </div>
    <!-- <div class="card-footer text-muted">2 days ago</div> -->
  </div>
  </div>
</body>

</html>
