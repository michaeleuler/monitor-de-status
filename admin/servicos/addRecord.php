<?php
	if(isset($_POST['servico']) && isset($_POST['porta']))
	{
		// include Database connection file 
    include("../../config/db_connection.php");

		// get values 
		$servico = $_POST['servico'];
		$porta = $_POST['porta'];


		$query = "INSERT INTO servicos(servico, porta, status) VALUES('$servico', '$porta', 1)";
		if (!$result = mysqli_query($db, $query)) {
	        exit(mysqli_error());
	    }
	    echo "Servidor adicionado!";
		
	}
	
	print $servidor;
?>