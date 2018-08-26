<?php
	if(isset($_POST['nome_user']) && isset($_POST['email_user']) && isset($_POST['senha_user']) && isset($_POST['nivel_user']))
	{
		// include Database connection file 
		include("../../config/db_connection.php");

		// get values 
		$nome = $_POST['nome_user'];
		$email = $_POST['email_user'];
		$senha = md5($_POST['senha_user']);
		$nivel = $_POST['nivel_user'];


		$query = "INSERT INTO user(nome, email, senha, nivel) VALUES('$nome', '$email', '$senha', $nivel)";
		if (!$result = mysqli_query($db, $query)) {
	        exit(mysqli_error());
	    }
	    echo "Servidor adicionado!";
	}
?>