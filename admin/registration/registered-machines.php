<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Tea Vending Machine</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">

  <!-- Custom styles for this template -->
  <link href="../dashboard.css" rel="stylesheet" />
</head>

<body>

  <?php include "../../includes/navigation.php"; ?>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./registered-customers.php">
                <span data-feather="users"></span>
                Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="./registered-machines.php">
                <span data-feather="server"></span>
                Machines
              </a>
            </li>
          </ul>

          <!-- 
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Current month
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Last quarter
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Year-end sale
              </a>
            </li>
          </ul> -->

        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="mt-5 mb-3 clearfix">
          <h2 class="pull-left">Machine Details</h2>
          <a href="register-machine.php" class="btn btn-outline-secondary my-sm-0 pull-right" class="btn btn-sm btn-outline-secondary"> Add New Machine</a>
        </div>
        <?php
        // Include config file
        require_once "../../includes/db.php";

        // Attempt select query execution
        $sql = "SELECT * FROM machine";
        if ($result = mysqli_query($link, $sql)) {
          if (mysqli_num_rows($result) > 0) {
            echo '<table class="table table-hover" id="machines_table">';
            echo "<thead>";
            echo "<tr>";
            echo '<th scope="col">#</th>';
            echo '<th scope="col">Machine ID</th>';
            echo '<th scope="col">Location</th>';
            echo '<th scope="col">Action</th>';
            echo '</tr>';
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_array($result)) {
              echo "<tr>";
              echo '<td scope="row">' . $row['id'] . '</td>';
              echo '<td scope="col">' . $row['machine_id'] . '</td>';
              echo '<td scope="col">' . $row['location'] . '</td>';
              echo '<td scope="col">';
              // echo '<a href="machine_update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>';
              echo '<a href="../delete/delete-machine.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><i class="fa fa-trash"></i></a>';
              echo '</td>';
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
        <!-- TODO: add update, create forms -->
      </main>
    </div>
  </div>

  <!-- Bootstrap core JavaScript
================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready(function() {
      $('#machines_table').DataTable();
    });
  </script>

  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace();
  </script>

</body>

</html>