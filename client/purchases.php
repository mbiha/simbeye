<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Transactions</title>
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
</head>

<body>
  <nav class="navbar navbar-dark bg-dark justify-content-between">
    <a class="btn btn-outline-secondary my-sm-0" href="index.php">Home</a>
    <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
        Search
      </button>
    </form>
  </nav>
  <main role="main" class="col-md-9 ml-sm-auto ml-lg-5 col-lg-10 pt-3 px-4">
    <?php
    // Include config file
    require_once "../includes/db.php";

    // Attempt select query execution
    $sql = "SELECT id, updated_at, amount_paid FROM payment_item"; // TODO: where clause
    if ($result = mysqli_query($link, $sql)) {
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
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['updated_at'] . "</td>";
          echo "<td>Tea</td>";                          // TODO: Fix this
          echo "<td>" . $row['amount_paid'] . "</td>";
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

    // Close connection
    mysqli_close($link);
    ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
</body>

</html>