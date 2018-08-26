<?php
// include Database connection file
include("../../config/db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['smtp_id'];
    $serv_smtp = $_POST['serv_smtp'];
    $porta_smtp = $_POST['porta_smtp'];
	$user_smtp = $_POST['user_smtp'];	
	$user_senha = $_POST['senha_smtp'];	


    // Updaste User details
    $query = "UPDATE sistema SET smtp = '$serv_smtp', porta = $porta_smtp, usuario = '$user_smtp', senha = '$user_senha'";
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
	
}

 print  $id;
 print $serv_smtp;
 print      $porta_smtp;
 print  	$user_smtp;	
 print  	$user_senha;	