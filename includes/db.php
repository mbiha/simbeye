<?php
define('DB_SERVER', 'sql304.ezyro.com');
define('DB_USERNAME', 'ezyro_33954586');
define('DB_PASSWORD', 'e67btd0w');
define('DB_NAME', 'ezyro_33954586_vending_machine');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
