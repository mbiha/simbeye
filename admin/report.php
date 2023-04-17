<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
              <a class="nav-link" href="report.php">
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
        
    <div class="container text-center">
        <h1 class="mt-5">Sales Table</h1>
        <hr>

        <?php
        // Include config file
        require_once "../includes/db.php";
        
        $sql = "SELECT * FROM sales";
        
        $result = mysqli_query($link, $sql);
        
        if ($result->num_rows > 0) {
            // Generate sales report table
            echo '<table class="table table-striped table-responsive col mx-auto" style = "height:500px; width:700px;">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Machine</th>';
            echo '<th>Item</th>';
            echo '<th>Price</th>';
            echo '<th>Card/Coin</th>';
            echo '<th>Time</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['machine_id'] . '</td>';
                echo '<td>' . $row['item'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td>' . $row['customer_id'] . '</td>';
                echo '<td>' . $row['time'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
         } else {
            echo "No sales data found.";
         }
            ?>
            </div>
            <div class = "container text-centered">
                <div class = "row">
                    <div class = "col-6">
            <h2 class="mt-5">Sales by Location</h1>
            <hr>
            <?php
            // Generate sales report pie chart
            $data = "";
            $labels = "";
            $sql = "SELECT machine_id, SUM(price) AS total_sales FROM sales GROUP BY machine_id";
            $result = mysqli_query($link, $sql);
            while ($row = $result->fetch_assoc()) {
                $data .= $row['total_sales'] . ",";
                $labels .= '"' . $row['machine_id'] . '",';
            }
            $data = rtrim($data, ",");
            $labels = rtrim($labels, ",");
            echo '<canvas id="sales-chart" height="300px" width="300px"></canvas>';
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>';
            echo '<script>';
            echo 'var ctx = document.getElementById("sales-chart").getContext("2d");';
            echo 'var myChart = new Chart(ctx, {';
            echo 'type: "pie",';
            echo 'data: {';
            echo 'labels: [' . $labels . '],';
            echo 'datasets: [{';
            echo 'label: "Sales",';
            echo 'data: [' . $data . '],';
            echo 'backgroundColor: [';
            echo '"#FF6384",';
            echo '"#36A2EB",';
            echo '"#FFCE56",';
            echo '"#5cb85c",';
            echo '"#5bc0de",';
            echo '"#f0ad4",';
            echo '"#d9534f",';
            echo '"#292b2c"';
            echo ']';
            echo '}]';
            echo '},';
            echo 'options: {';
            echo 'responsive: false,';
            echo 'maintainAspectRatio: false,';
            echo '}';
            echo '});';
            echo '</script>';
           
        ?>
        </div>
            <div class = "col-6">
            <h2 class="mt-5">Sales by Payment Method</h1>
            <hr>
            <?php
            // Generate sales report pie chart
            $data2 = "";
            $labels2 = "";
            $sql = "SELECT customer_id, SUM(price) AS total_sales FROM sales GROUP BY customer_id";
            $result = mysqli_query($link, $sql);
            while ($row = $result->fetch_assoc()) {
                $data2 .= $row['total_sales'] . ",";
                $labels2 .= '"' . $row['customer_id'] . '",';
            }
            $data = rtrim($data2, ",");
            $labels = rtrim($labels2, ",");
            echo '<canvas id="sales-chart2" height="300px" width="300px"></canvas>';
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>';
            echo '<script>';
            echo 'var ctx = document.getElementById("sales-chart2").getContext("2d");';
            echo 'var myChart = new Chart(ctx, {';
            echo 'type: "pie",';
            echo 'data: {';
            echo 'labels: [' . $labels2 . '],';
            echo 'datasets: [{';
            echo 'label: "Sales",';
            echo 'data: [' . $data2 . '],';
            echo 'backgroundColor: [';
            echo '"#FF6384",';
            echo '"#36A2EB",';
            echo '"#FFCE56",';
            echo '"#5cb85c",';
            echo '"#5bc0de",';
            echo '"#f0ad4",';
            echo '"#d9534f",';
            echo '"#292b2c"';
            echo ']';
            echo '}]';
            echo '},';
            echo 'options: {';
            echo 'responsive: false,';
            echo 'maintainAspectRatio: false,';
            echo '}';
            echo '});';
            echo '</script>';
            echo '</div>';
            mysqli_close($link);
            ?>
        </div>
        </div>
            
      </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
