

<?php

	session_start();
	$rowid = $_SESSION['rowid'];
include("../../config/db_connection.php");
//servi�os
	print '<table id="servicos_table" class="table table-bordered table-striped">
						<tr>
							<th>Servico</th>
							<th>Porta</th>
							<th>	
							</th>
							
						</tr>';



	$query2 = "SELECT * FROM servicos where servidor = $rowid order by servico ASC";

	if (!$result2 = mysqli_query($db, $query2)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result2) > 0)
    {
    	$number = 1;
    	while($row2 = mysqli_fetch_assoc($result2))
    	{
    		print '<tr>';
			print '<td>'.$row2['servico'].'</td>';
			print '<td>'.$row2['porta'].'</td>';
			print '<td>';
					print '<button onclick="DeleteUser2('.$row2['id'].')" class="btn btn-danger" data-placement="top" title="Excluir"><span class="glyphicon glyphicon-trash"></span></button>';
						
					

					
				print '</td></tr>

				';
    		$number++;
    	}
	
    }
	
    else
    {
    	// records now found 

    }

    print '</table>';
