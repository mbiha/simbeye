<?php
if(isset($_GET['item'])) {
    $item = $_GET['item'];
} else {
    $item = "Tea";
}

$connection = mysqli_connect('localhost', 'root', '', 'vending_machine');

if(!$connection) {
    die("Cannot connect");
}

$query = "SELECT price FROM price WHERE item= '{$item}' LIMIT 1";
$fetch_data = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($fetch_data)) {
    $price = $row['price'];
    echo $price;

}
?>