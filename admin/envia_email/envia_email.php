<html>
  <head>
    <meta charset="UTF-8">
	</head>
<body>	
<?php

	// include Database connection file 
	include("../../config/db_connection.php");
	// Inclui o arquivo class.phpmailer.php localizado na pasta class
	require_once("class/class.phpmailer.php");
 
	// Inicia a classe PHPMailer
	$mail = new PHPMailer(true);
	// Define que a mensagem será SMTP		
	$mail->IsSMTP(); 


	print '<table class="table table-bordered table-striped">';

	$query = "SELECT * FROM servidores where notifica = 1
	order by INET_ATON(ip)";

	if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($servidores = mysqli_fetch_assoc($result))
    	{
    		print '<tr>';
			print '<td>'.$servidores['ip'].'</td>';
			print'</td>';
			

				
			print '<td>';
			
			
//atualiza status			
			$query2 = 'SELECT * FROM servicos where servidor = '.$servidores['id'].' order by servico ASC';

			if (!$result2 = mysqli_query($query2)) {
			exit(mysqli_error());
			}

			// if query2 results contains rows then featch those rows 
			if(mysqli_num_rows($result2) > 0)
			{
				$number = 1;
				//$cont = 0;
				while($servicos = mysqli_fetch_assoc($result2))
				{
					
					$conexao =@fsockopen($servidores['ip'], $servicos['porta'],$erro,$erro,1);  
					if(!$conexao){ 
					

					echo '<span class="label label-danger">'.$servicos['servico'].'</span>&nbsp;'; 					

									
					
					//envia email
				if($servidores['notifica'] == 1 && $servicos['status'] == 1)
				{	
					$id = $servicos['id'];
					$insert = "UPDATE servicos SET status = 0 WHERE id = '$id'";
					if (!$result9 = mysqli_query($insert)) {
					exit(mysqli_error());
					}
				}
					
					} 
					else{
						if($servicos['status'] == 0)
						{
					$id = $servicos['id'];
					$insert = "UPDATE servicos SET status = 1 WHERE id = '$id'";
					if (!$result9 = mysqli_query($insert)) {
					exit(mysqli_error());
					}
					$id_serv = $servidores['id'];	
					$insert2 = "UPDATE servidores SET status = 1 WHERE id = '$id_serv'";
					if (!$result10 = mysqli_query($insert2)) {
					exit(mysqli_error());
					}	
						}					
						
					}					

					$number++;
				}}			
			;		
			
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
	
	
//envia email	

 
	// Inicia a classe PHPMailer
	$mail = new PHPMailer(true);
	// Define que a mensagem será SMTP		
	$mail->IsSMTP(); 


	print '<table class="table table-bordered table-striped">';

	$query = "select servidores.id as id, nome, ip, group_concat(porta) as porta, group_concat(servico) as servicos, servidores.status as serv_status
				from servicos
				INNER JOIN servidores ON servicos.servidor = servidores.id
				where notifica = 1
				and servicos.status = 0
				group by nome
				order by servidor";

	if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($servidores = mysqli_fetch_assoc($result))
    	{
			$ip = $servidores['ip'];
			$server = $servidores['nome'];
			$service = array($servidores['servicos']);
			$porta = array($servidores['porta']);
	
			$services = $service;					
			$fora = implode($services);
			print $server.' - '.$fora.'<br> ';
    		$number++;
			
			if($servidores['serv_status'] == 1)
			{
					
				try 
				{				
				 $mail->Host = 'smtp.teste.com.br'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
				 $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
				 $mail->Port       = 587; //  Usar 587 porta SMTP
				 $mail->Username = 'teste@teste.com.br'; // Usuário do servidor SMTP (endereço de email)
				 $mail->Password = 'teste'; // Senha do servidor SMTP (senha do email usado)
			 
				 //Define o remetente
				 // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
				 $mail->SetFrom('teste@teste.com.br', 'Nome'); //Seu e-mail
				 $mail->AddReplyTo('teste@teste.com.br', 'Nome'); //Seu e-mail
				 $mail->Subject = utf8_decode('ATENÇÃO! Verificar o servidor '.$server.'('.$ip.')');//Assunto do e-mail
			 
			 
				 //Define os destinatário(s)
				 //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
				 $mail->AddAddress('teste@teste.com.br');
			 
			 
				 $msg = ' Os serviços '.$fora.' estão fora do ar';
				 //Define o corpo do email
				 $mail->MsgHTML(utf8_decode($msg)); 
					 
				 ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
				 //$mail->MsgHTML(file_get_contents('arquivo.html'));
			 
				 $mail->Send();
				 echo "Mensagem enviada com sucesso</p>\n";
			 
				//caso apresente algum erro é apresentado abaixo com essa exceção.
				}catch (phpmailerException $e) 
				{
				  echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
				}
						
				$id_serv = $servidores['id'];
				
				$update_server_status = "UPDATE servidores SET status = 0 WHERE id = '$id_serv'";
				if (!$result_server_status = mysqli_query($update_server_status)) {
				exit(mysqli_error());	
				}
				$eventos = "insert into eventos (servidor, servicos ,inicio, tipo) VALUES ('$id_serv' ,'$fora' , NOW(), 3)";
				if (!$result_evento = mysqli_query($eventos)) {
				exit(mysqli_error());	
				}
			
			}
						
		}
		
		
    }
    else
    {
    	// records now found 
    	print '<tr><td colspan="6">Nenhum servidor fora do ar!</td></tr>';
    }

    print '</table>';	

echo "<script>window.open('', '_self', ''); window.close();</script>";
?>
  </body>
</html>