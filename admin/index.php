<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <!-- <link rel="icon" href="../../../../favicon.ico" /> -->

  <title>Tea Vending Machine</title>

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css" />

  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Group 05</a>
    <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" /> -->
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./registration/registered-customers.php">
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
              <a class="nav-link" href="registration/registered-machines.php">
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <a href="registration/price.php" class="btn btn-sm btn-outline-secondary">
                Price
              </a>

              <a href="registration/register-customer.php" class="btn btn-sm btn-outline-secondary">
                Register Customer
              </a>

              <!-- <button class="btn btn-sm btn-outline-secondary">
                <a href="./registration/registration-form.html" style="text-decoration:none; color:inherit;">Register Customer</a>
              </button> -->
            </div>
            <button class="btn btn-sm btn-outline-secondary">
              <span data-feather="calendar"></span>
              <select class="custom-select-sm">
                <option selected>Today</option>
                <option value="1">This Week</option>
                <option value="2">This Month</option>
              </select>
            </button>
          </div>
        </div>

        <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

        <h2 id="customers">Card Sales</h2>
      //  <?php
        // Include config file
      //  require_once "../includes/db.php";

//         // Attempt select query execution
//         $sql = "SELECT p.id, m.machine_id, m.location, c.card_number, p.price FROM sales AS p INNER JOIN machine AS m ON p.machine_id = m.machine_id INNER JOIN customer AS c on p.customer_id = c.id";

//         if ($result = mysqli_query($link, $sql)) {
//           if (mysqli_num_rows($result) > 0) {
//             echo '<table class="table table-hover" id="sales_table">';
//             echo "<thead>";
//             echo "<tr>";
//             echo "<th>#</th>";
//             echo "<th>Machine ID</th>";
//             echo "<th>Item</th>";
//             echo "<th>Price (Tsh)</th>";
//             echo "<th>Card Number</th>";
//             echo "<th>Location</th>";
//             echo "</tr>";
//             echo "</thead>";
//             echo "<tbody>";
//             while ($row = mysqli_fetch_array($result)) {
//               echo "<tr>";
//               echo "<td>" . $row['id'] . "</td>";
//               echo "<td>" . $row['machine_id'] . "</td>";
//               echo "<td>Tea</td>";                          // TODO: Fix this
//               echo "<td>" . $row['price'] . "</td>";
//               echo "<td>" . $row['card_number'] . "</td>";
//               echo "<td>" . $row['location'] . "</td>";
//               echo "</tr>";
//             }
//             echo "</tbody>";
//             echo "</table>";
//             // Free result set
//             mysqli_free_result($result);
//           } else {
//             echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
//           }
//         } else {
//           echo "Oops! Something went wrong. Please try again later.";
//         }

        

//         // Close connection
//         mysqli_close($link);
//         ?>
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
    window.jQuery ||
      document.write(
        '<script src="../assets/js/vendor/jquery-slim.min.js"><\/script>'
      );
  </script>

  <script>
    $(document).ready(function() {
      $("#sales_table").DataTable();
    });
  </script>

  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace();
  </script>

  <!-- Graphs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: [
          "Sunday",
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
        ],
        datasets: [{
          data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
          lineTension: 0,
          backgroundColor: "transparent",
          borderColor: "#007bff",
          borderWidth: 4,
          pointBackgroundColor: "#007bff",
        }, ],
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false,
            },
          }, ],
        },
        legend: {
          display: false,
        },
      },
    });
  </script>
</body>

</html>
