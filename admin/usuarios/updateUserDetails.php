<?php
// include Database connection file
include("../../config/db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
	$senha = md5($_POST['senha']);	
	$nivel = $_POST['nivel'];		

    // Updaste User details
    $query = "UPDATE user SET nome = '$nome', email = '$email', senha = '$senha', nivel = '$nivel' WHERE id = '$id'";
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
}