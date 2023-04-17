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
        // Include config file
        require_once "../includes/db.php";
        
        $sql = "SELECT * FROM sales";
        
        $result = mysqli_query($link, $sql);
        
        if ($result->num_rows > 0) {
            // Generate sales report table
            echo '<table class="table table-striped table-responsive" style = "height:400px;">';
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
            echo '<canvas id="sales-chart" height="100px"></canvas>';
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
            echo 'maintainAspectRatio: true,';
            echo '}';
            echo '});';
            echo '</script>';
            } else {
            echo "No sales data found.";
            }
            mysqli_close($link);
            ?>
      </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
