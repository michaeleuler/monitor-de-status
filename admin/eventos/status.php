<?php
	// include Database connection file 
	include("../../config/db_connection.php");

	// Design initial table header 
	print '<table class="table table-bordered table-striped">
						<tr>
							<th>IP</th>
							<th>Nome</th>
							<th>Serviços</th>
							<th>Prioridade</th>							
						</tr>';


	$query = "SELECT nome, ip, prioridade as prior from servidores
		order by INET_ATON(ip)";

	if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysqli_fetch_assoc($result))
    	{
    		print '<tr>';
			print '<td>'.$row['ip'].'</td>';
			print '<td>'.$row['nome'].'</td>';

			
			print '<td>';
					   
			print '</td>';
				
			print '<td>';
				
				if ($row['prior'] == 0){
				print '<span class="label label-warning">Prioridade Alta</span>';
				} 
				if ($row['prior'] == 1){
				print '<span class="label label-info">Prioridade Média</span>';
				} 
				if ($row['prior'] == 2){
				print '<span class="label label-info">Prioridade Baixa</span>';
				} 				
				print '</td>';
				print '</td>';
							
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	print '<tr><td colspan="6">Nenhum registro encontrado!</td></tr>';
    }

    print '</table>';


?>
