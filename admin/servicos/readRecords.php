<?php
	// include Database connection file 
	include("../../config/db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Serviço</th>
							<th>porta</th>
							<th><div class="row">
        <div class="col-md-12">
            <div class="pull-left">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal2">Add serviço</button>
            </div>
        </div>
    </div></th>
							
						</tr>';

	$query = "
	SELECT * FROM servicos order by servico;
	
	";

	if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysqli_fetch_assoc($result))
    	{
    		$data .= '<tr>
				<td>'.$row['servico'].'</td>
				<td>'.$row['porta'].'</td>
				<td>
					<button onclick="GetUserDetails2('.$row['id'].')" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></button> 
					<button onclick="DeleteUser2('.$row['id'].')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>

					
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">Nenhum registro encontrado!</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>














