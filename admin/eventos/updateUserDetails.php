<?php
// include Database connection file
include("../../config/db_connection.php");

// check request
if(isset($_POST))
{
    // get values
		$id = $_POST['id'];	
		$tipo = $_POST['tipo'];		
		$motivo = $_POST['motivo'];
		$solucao = $_POST['solucao'];		
		$fim = $_POST['fim'];


	
    // Updaste User details
    $query = "UPDATE eventos SET tipo = '$tipo', motivo = '$motivo', solucao = '$solucao', fim = '$fim' WHERE id = '$id'";
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
}
