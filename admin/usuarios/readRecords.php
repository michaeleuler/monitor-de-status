<?php
	// include Database connection file 
	include("../../config/db_connection.php");

	// Design initial table header 
	print '<table class="table table-bordered table-striped">
						<tr>
							<th>Cod.</th>
							<th>Nome</th>
							<th>Email</th>
							<th>Nível</th>
							<th><div class="row">
        <div class="col-md-12">
            <div class="pull-left">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_user">Add usuário</button>
            </div>
        </div>
    </div></th>
							
						</tr>';


	$query = "SELECT * FROM user
	order by nome asc";

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
			print '<td>'.$row['id'].'</td>';
			print '<td>'.$row['nome'].'</td>';
						print '<td>'.$row['email'].'</td>';
			print '<td>';
				
				if ($row['nivel'] == 0){
				print '<span class="label label-success">Admin</span>';
				} 
				if ($row['nivel'] == 1){
				print '<span class="label label-info">User</span>';
				} 				
				print '</td>';
				print '</td>';
							
				print '<td>
					<button onclick="GetUserDetails3('.$row['id'].')" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></button>
					<button onclick="DeleteUser3('.$row['id'].')" class="btn btn-danger" data-placement="top" title="Excluir"><span class="glyphicon glyphicon-remove"></span></button>';
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
