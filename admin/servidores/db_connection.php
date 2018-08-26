<?php

// Connection variables 
$host = "localhost"; // mysqli host name eg. localhost
$user = "root"; // mysqli user. eg. root ( if your on localserver)
$password = "b0r3d4_d4"; // mysqli user password  (if password is not set for your root user then keep it empty )
$database = "status"; // mysqli Database name

// Connect to mysqli Database 
$db = mysqli_connect($host, $user, $password) or die("Could not connect to database");

// Select mysqli Database 
mysqli_select_db($database, $db);

?>