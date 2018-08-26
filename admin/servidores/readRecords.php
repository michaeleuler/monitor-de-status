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
							<th><div class="row">
        <div class="col-md-12">
            <div class="pull-left">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Novo</button>

            </div>
        </div>
    </div></th>
							
						</tr>';


	$query = "SELECT * FROM servidores
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
			print '<td>';
			
			
			if ($row['tipo'] == 0){
				print'<i class="fa fa-server" aria-hidden="true"></i>&nbsp;'.$row['nome'];
			}	
			if ($row['tipo'] == 1){
				print '&nbsp;'.$row['nome'];
			}			
			if ($row['tipo'] == 2){
				print'<i class="fa fa-print" aria-hidden="true"></i>&nbsp;'.$row['nome'];
			}
			if ($row['tipo'] == 3){
				print'&nbsp;'.$row['nome'];
			}			
			else{
			}
			
			
			
			print'</td>';
			

				
			print '<td>';
			
			
			
			$query2 = 'SELECT * FROM servicos where servidor = '.$row['id'].' order by servico ASC';

			if (!$result2 = mysqli_query($db, $query2)) {
			exit(mysqli_error());
			}

			// if query2 results contains rows then featch those rows 
			if(mysqli_num_rows($result2) > 0)
			{
				$number = 1;
				while($row2 = mysqli_fetch_assoc($result2))
				{
					
					$conexao =@fsockopen($row['ip'], $row2['porta'],$erro,$erro,1);  
					if($conexao){  
					echo '<span class="label label-success">'.$row2['servico'].'</span>&nbsp;';  
					}  
					else  {
					echo '<span class="label label-danger">'.$row2['servico'].'</span>&nbsp;'; 
				}   
			
					$number++;
				}}			
			
			
			print '</td>';
			print '<td>';
				
				if ($row['prioridade'] == 0){
				print '<span class="label label-warning">Alta</span>';
				} 
				if ($row['prioridade'] == 1){
				print '<span class="label label-primary">Baixa</span>';
				} 
				if ($row['prioridade'] == 2){
				print '<span class="label label-info">Baixa</span>';
				} 				
				print '</td>';
				print '</td>';
							
				print '<td>
					<button onclick="GetUserDetails('.$row['id'].')" class="btn btn-secondary"><span class="glyphicon glyphicon-pencil"></span></button>
					

					';
					
					print '<button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger" data-placement="top" title="Excluir"><span class="glyphicon glyphicon-trash"></span></button>';
						
					

					
				print '</td></tr>';
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
