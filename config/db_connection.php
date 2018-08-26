<?php

// Connection variables 
$host = "localhost"; // mysqli host name eg. localhost
$user = "root"; // mysqli user. eg. root ( if your on localserver)
$password = ""; // mysqli user password  (if password is not set for your root user then keep it empty )
$database = "status"; // mysqli Database name

// Connect to mysqli Database 
$db = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");



?>