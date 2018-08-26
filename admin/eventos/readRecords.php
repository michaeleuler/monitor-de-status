<?php

	// include Database connection file 
	include("../../config/db_connection.php");
//converte hora
  function m2h($mins) {
    // Se os minutos estiverem negativos
    if ($mins < 0)
      $min = abs($mins); 
    else
      $min = $mins; 
    // Arredonda a hora
    $h = floor($min / 60); 
    $m = ($min - ($h * 60)) / 100; 
    $horas = $h + $m; 
    // Detalhe: Aqui também pode se usar o abs()
    if ($mins < 0)
      $horas *= -1; 
    // Separa a hora dos minutos
    $sep = explode('.', $horas); 
    $h = $sep[0]; 
    if (empty($sep[1]))
      $sep[1] = 00; 
    $m = $sep[1]; 
    // Aqui um pequeno artifício pra colocar um zero no final
    if (strlen($m) < 2)
      $m = $m . 0; 
    return sprintf('%02d:%02d', $h, $m); 
  } 
 
	
	//filtros pesquisa 
	if(!empty($_POST['dispositivo'])){
	$dispositivo = ' where eventos.servidor = '.$_POST['dispositivo'];
	}
	else{
	$dispositivo = ' where eventos.servidor <> 0';	
	}
	if(!empty($_POST['tipo'])){
	$type = ' and eventos.tipo = '.$_POST['tipo'];
	}
	else{
	$type = '';	
	}

	if(!empty($_POST['motivo'])){
	$motiv = $_POST['motivo'];	
	$motivo =  " and motivo like '%$motiv%'";
	}
	else{
	$motivo =  '';	
	}
	if(!empty($_POST['de']) && !empty($_POST['ate'])){
	$de  = $_POST['de'].' 00:00';
	$ate = $_POST['ate'].' 23:59';
	$data = "and inicio BETWEEN '$de' AND '$ate'" ;
	}
	else{
	$data = '';	
	}

	
	// Design initial table header 
	print '<table class="table table-bordered table-striped">
						<tr>
							<th>Servidor</th>
							<th>Serviço</th>
							<th>Tipo</th>
							<th>Inicio</th>
							<th>Fim</th>
							<th>Tempo parado</th>
							<th><div class="row">
        <div class="col-md-12">
            <div class="pull-left">
                <button class="btn btn-success" data-toggle="modal" data-target="#search_eventos"><span class="glyphicon glyphicon-search"></span>&nbsp;Pesquisar</button>

            </div>
        </div>
    </div></th>
							
						</tr>';
// ocorrencias sem otivo preenchido

	$query_ = 	"select eventos.id as event_id, servidores.id, servidores.nome, servidores.ip, servicos, motivo, tipo_problema.descricao, 
					date_format(inicio, '%d/%m/%Y' ' às ' '%H:%i') as inicio, date_format(fim, '%d/%m/%Y' ' às ' '%H:%i') as fim,
					concat(TIMESTAMPDIFF (MINUTE, inicio, fim),'H') as tempo_parado, eventos.servidor					from eventos
					INNER JOIN servidores ON eventos.servidor = servidores.id
					INNER JOIN tipo_problema ON eventos.tipo = tipo_problema.id
					where eventos.motivo is NULL
					order by inicio DESC
				";

	if (!$result_ = mysqli_query($db, $query_)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result_) > 0)
    {
    	$number = 1;
    	while($row_ = mysqli_fetch_assoc($result_))
    	{
    		print '<tr>';
			print '<td>'.$row_['nome'].' ('.$row_['ip'].')</td>';
			print '<td>'.$row_['servicos'].'</td>';
			print '<td>'.utf8_encode($row_['descricao']).'</td>';
			print '<td>'.$row_['inicio'].'</td>';
			print '<td>'.$row_['fim'].'</td>';
			print '<td>'.m2h($row_['tempo_parado']).'</td>';	
			print '<td><button onclick="GetEventDetails('.$row_['event_id'].')" class="btn btn-danger"><span class="glyphicon glyphicon-pencil"></span>Preencher motivo</button>';

			print '</td></tr>';
			$number++;
    	}
    }
						
						
						
						
						
// ocorrencias nos ultimos 7 dias
	$query = 	"select eventos.id as event_id, servidores.id, servidores.nome, servidores.ip, servicos, motivo, tipo_problema.descricao, 
					date_format(inicio, '%d/%m/%Y' ' às ' '%H:%i') as inicio, date_format(fim, '%d/%m/%Y' ' às ' '%H:%i') as fim,
					concat(TIMESTAMPDIFF (MINUTE, inicio, fim),'H') as tempo_parado, eventos.servidor					from eventos
					INNER JOIN servidores ON eventos.servidor = servidores.id
					INNER JOIN tipo_problema ON eventos.tipo = tipo_problema.id
					$dispositivo
					and eventos.motivo is not null
					$type
					$motivo
					$data
					order by inicio DESC
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
    		print '<tr>';
			print '<td>'.$row['nome'].' ('.$row['ip'].')</td>';
			print '<td>'.$row['servicos'].'</td>';
			print '<td>'.utf8_encode($row['descricao']).'</td>';
			print '<td>'.$row['inicio'].'</td>';
			print '<td>'.$row['fim'].'</td>';
			print '<td>'.m2h($row['tempo_parado']).'</td>';	
			print '<td><button onclick="GetEventDetails('.$row['event_id'].')" class="btn btn-secondary"><span class="glyphicon glyphicon-eye-open"></span></button>';	
			print '</td></tr>';
			$number++;
    	}
    }
	//total de horas paradas
	$query2 = 	"	select SUM(TIMESTAMPDIFF (MINUTE, inicio, fim)) as total
					from eventos
					INNER JOIN servidores ON eventos.servidor = servidores.id
					INNER JOIN tipo_problema ON eventos.tipo = tipo_problema.id
					$dispositivo
					$type
					$motivo
					$data
					order by motivo ASC, inicio
				";

	if (!$result2 = mysqli_query($db,$query2)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result2) > 0)
    {
    	$number2 = 1;
    	while($row2 = mysqli_fetch_assoc($result2))
    	{
    		print '<tr>';
			print '<td colspan="5" ><b>Total de Horas paradas<b></td>';			
			print '<td>'.m2h($row2['total']).'</td>';
			print '<td></td>';			
			
			print '</td></tr>';
			$number2++;
    	}
    }	
	
	    else
    {
    	// records now found 
    	print '<tr><td colspan="6">Nenhum registro encontrado!</td></tr>';
    }

    print '</table>';
?>
