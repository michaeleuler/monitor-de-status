<?php
// include Database connection file
include("../../config/db_connection.php");

// check request
if(isset($_POST))
{
    // get values
		$id = $_POST['id'];	
		$nome = $_POST['nome'];
		$ip = $_POST['ip'];
		$desc = $_POST['desc'];		
		$prior = $_POST['prior'];
		$tipo = $_POST['tipo'];
		$virtual = $_POST['virtual'];
		$email = $_POST['email'];	
	
    // Updaste User details
    $query = "UPDATE servidores SET nome = '$nome', ip = '$ip', prioridade = $prior, descricao = '$desc', tipo = $tipo, `virtual` = '$virtual', notifica = $email 
	WHERE id = '$id'";
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
}


	if(isset($_POST['servico']) && isset($_POST['porta']))
	{

		$servico 	= $_POST['servico'];
		$porta	 	=  $_POST['porta'];
		$id_serv 	= $id;
		
		$n = count($servico);
		for ($i=0; $i<$n; $i++){

		
		$query = "INSERT INTO servicos(servico, porta, servidor, status) VALUES('$servico[$i]', '$porta[$i]', '$id_serv', 1)";
		if (!$result = mysqli_query($db, $query)) {
	        exit(mysqli_error());
	    }
	    echo "Serviço adicionado!";
		
		}

		
	}