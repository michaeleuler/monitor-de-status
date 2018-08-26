<?php
// include Database connection file
include("../../config/db_connection.php");

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $user_id = $_POST['id'];

    // Get User Details
    $query = "select eventos.id, servidores.id, servidores.nome, servidores.ip, servicos, motivo, solucao, 
				date_format(inicio, '%d/%m/%Y' ' às ' '%H:%i') as inicio, 
					date_format(fim, '%Y-%m-%dT%H:%i') as fim, 
					eventos.tipo as tipo
					from eventos
					INNER JOIN servidores ON eventos.servidor = servidores.id
					WHERE eventos.id = $user_id";
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
    $response = array();
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Não encontrado!";
    }
    // display JSON data

    $obj = json_encode($response);
	echo $obj;
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}

