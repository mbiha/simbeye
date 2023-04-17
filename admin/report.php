<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Sales Report</h1>
        <hr>

        <?php
        // Fetch sales data from the database
        $host = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "sales_db";

        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM sales";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Generate sales report table
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Product Name</th>';
            echo '<th>Quantity Sold</th>';
            echo '<th>Total Sales</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['product_name'] . '</td>';
                echo '<td>' . $row['quantity_sold'] . '</td>';
                echo '<td>' . $row['total_sales'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';

            // Generate sales report pie chart
            $data = "";
            $labels = "";
            $sql = "SELECT product_name, total_sales FROM sales";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $data .= $row['total_sales'] . ",";
                $labels .= '"' . $row['product_name'] . '",';
            }
            $data = rtrim($data, ",");
            $labels = rtrim($labels, ",");
            echo '<canvas id="sales-chart"></canvas>';
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
            echo 'responsive: true,';
            echo 'maintainAspectRatio: false,';
            echo '}';
            echo '});';
            echo '</script>';
            } else {
            echo "No sales data found.";
            }
            $conn->close();
            ?>
      </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
