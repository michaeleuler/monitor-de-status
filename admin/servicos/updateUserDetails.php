<?php
// include Database connection file
include("../../config/db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $servico = $_POST['servico'];
    $porta = $_POST['porta'];
	$servidor = $_POST['servidor'];

    // Updaste User details
    $query = "UPDATE servicos SET servico = '$servico', porta = '$porta', servidor = '$servidor' WHERE id = '$id'";
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
}