<?php

if(isset($_GET['card_number'])) {
    $card_number = $_GET['card_number'];
}

$connection = mysqli_connect('localhost', 'root', '', 'vending_machine');

if(!$connection) {
    die("Cannot connect");
}

$query = "SELECT card_amount FROM customer WHERE card_number= '{$card_number}' LIMIT 1";
$fetch_data = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($fetch_data)) {
    $card_amount = $row['card_amount'];
    echo $card_amount;

}
?>
