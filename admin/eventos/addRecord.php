<?php
	if(isset($_POST['nome']) && isset($_POST['ip']))
	{
		// include Database connection file 
		include("../../config/db_connection.php");

		// get values 
		$nome = $_POST['nome'];
		$ip = $_POST['ip'];
		$desc = $_POST['desc'];		
		$prior = $_POST['prior'];
		$tipo = $_POST['tipo'];
		$virtual = $_POST['virtual'];
		$email = $_POST['email'];	



		$query = "INSERT INTO servidores(nome, ip, descricao, prioridade, tipo, virtual, notifica) VALUES('$nome', '$ip', '$desc', '$prior', '$tipo', '$virtual', '$email')";
		if (!$result = mysqli_query($db, $query)) {
	        exit(mysqli_error());
	    }
	    echo "Servidor adicionado!";
	}
	

	if(isset($_POST['servico']) && isset($_POST['porta']))
	{

		$servico 	= $_POST['servico'];
		$porta	 	=  $_POST['porta'];
		$id_serv 	= mysqli_insert_id();
		
		$n = count($servico);
		for ($i=0; $i<$n; $i++){

		
		$query = "INSERT INTO servicos(servico, porta, servidor) VALUES('$servico[$i]', '$porta[$i]', '$id_serv')";
		if (!$result = mysqli_query($db, $query)) {
	        exit(mysqli_error());
	    }
	    echo "serviço adicionado!";
		
		}

		
	}	
?>


