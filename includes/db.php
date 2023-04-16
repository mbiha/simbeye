<?php
define('DB_SERVER', 'containers-us-west-2.railway.app:8042');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '1dN7r3mU2jkyJznmRxWJ');
define('DB_NAME', 'railway');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
