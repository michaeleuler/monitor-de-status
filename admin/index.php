<?php
//INICIO A SESSÃO
session_start();

//Verifico se o usuário está logado no sistema
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE) {
    header("Location: ../login/index.php");
}
else {

}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Status - TI |Alumipack</title>

    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"/>
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
</head>
<body>

<!-- Content Section -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Monitor de dispositivos 
	<div class="dropdown pull-right">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
  <span class="glyphicon glyphicon-user"></span> 
  <?php print $_SESSION["nome"];?>
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="../login/logoff.php">Desconectar</a></li>
  </ul>
  </div>
  </h1>
        </div>
    </div>
	
<ul class="nav nav-tabs">

	<li class="active"><a href="#servidores" data-toggle="tab"><span class="glyphicon glyphicon-hdd"> 	Dispositivos</a></li>
	<li><a href="#eventos" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Eventos	 </a></li>		
	<li><a href="#sistema" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Sistema </a></li>	
	<li><a href="#usuarios" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Usuários </a></li>	
			<?php 
			

print '<div class="text-right">
<button type="button" class="btn btn-default">';

?>
			</button>
        </div>	 
</ul>

<div class="tab-content">

  
	  <div id="servidores" class="tab-pane active in">

    <div class="row">
        <div class="col-md-12">


            <div class="records_content"></div>
        </div>
    </div>
</div>

	<div class="tab-pane" id="eventos">

    <div class="row">
        <div class="col-md-12">


            <div class="records_eventos"></div>
        </div>
    </div>
</div>

<!-- /Content Section -->



<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastrar novo dipositivo</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" placeholder="Nome" class="form-control" required="required" />
                </div>

                <div class="form-group">
                    <label for="ip">IP</label>
                    <input type="text" id="ip" placeholder="IP" class="form-control"/>
                </div>
				<div class="form-group">
                <label for="descricao">Descrição</label>
				<textarea rows="4" cols="50" id="desc" class="form-control"></textarea>
				</div>	
               
			   <div class="form-group">
			   <div class="col-xs-3">
                <label for=" ">Prioridade:</label>
                 <select class="form-control name="prior" id="prior">
					<option value="0">Alta</option>
					<option value="2">Baixa</option>
				</select>				
				</div>
				<div class="col-xs-3">
                 <label for="update_ip">Tipo:</label>
                 <select class="form-control name="tipo" id="tipo">
					<option value="0">Servidor</option>
					<option value="1">Storage</option>					
					<option value="2">Impressora</option>
					<option value="3">Outros</option>					
				</select>				
				</div>
				<div class="col-xs-3">
                 <label for="Virtual">Virtual?</label>
                 <select class="form-control name="virtual" id="virtual">
					<option value="1">Não</option>
					<option value="0">Sim</option>
				</select>
<br>				
				</div>	
				<div class="col-xs-3">
                 <label for="Enviar_E-mail">Enviar E-mail?</label>
                 <select class="form-control name="email" id="email">
					<option value="1">Sim</option>
					<option value="0">Não</option>					
				</select>
<br>				
				</div>					
				
				
                </div>
			
<table id="servicos_table2" class="table table-bordered table-striped">
						<tr>
							<th>Servico</th>
							<th>Porta</th>
							<th>	
							</th>
							
						</tr>				
		<tfoot>
		<tr>
		<td colspan="5" style="text-align: left;">
		<button class="btn btn-success" onclick="AddTableRow2()" type="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add</button>
		</td>
		</tr>
		</tfoot>
		</table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord()">Adicionar dispositivo</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar dispositivo</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="update_nome">Dispositivo</label>
                    <input type="text" id="update_nome" placeholder="Servidor" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_ip">IP</label>
                    <input type="text" id="update_ip" placeholder="IP" class="form-control"/>
                </div>
				
                <div class="form-group">
                    <label for="descricao">Descrição</label>
				<textarea rows="8" cols="50" id="update_desc" class="form-control"></textarea>
				</div>				
               
			   <div class="form-group">
			   <div class="col-xs-3">
                <label for=" ">Prioridade:</label>
                 <select class="form-control name="update_prior" id="update_prior">
					<option value="0">Alta</option>
					<option value="2">Baixa</option>
				</select>				
				</div>
				<div class="col-xs-3">
                 <label for="update_ip">Tipo:</label>
                 <select class="form-control name="update_tipo" id="update_tipo">
					<option value="0">Servidor</option>
					<option value="1">Storage</option>					
					<option value="2">Impressora</option>
					<option value="3">Outros</option>					
				</select>				
				</div>
				<div class="col-xs-3">
                 <label for="Virtual">Virtual?</label>
                 <select class="form-control name="update_virtual" id="update_virtual">
					<option value="1">Não</option>
					<option value="0">Sim</option>
				</select>
				</div>	
				<div class="col-xs-3">
                 <label for="Enviar_E-mail">Enviar E-mail?</label>
                 <select class="form-control name="update_email" id="update_email">
					<option value="1">Sim</option>
					<option value="0">Não</option>					
				</select>
<br>				
				</div>					
				
				
                </div>				

<div class="records_servicos"></div>	
		<tfoot>
		<tr>
		<td colspan="5" style="text-align: left;">
		<button class="btn btn-success" onclick="AddTableRow()" type="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add</button>
		</td>
		</tr>
		</tfoot>
		</table>

<div class="form-group">


<?php
	include("../config/db_connection.php");
?>

	</div>

            </div>
            <div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Atualizar</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>

<!--Modal pesquisa eventos -->

<div class="modal fade" id="search_eventos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pesquisar eventos</h4>
            </div>
            <div class="modal-body">
                
				<div class="form-group">
				<label for=" ">Dispositivo</label>
				<select class="form-control name="search_dispositivo" id="search_dispositivo">
				<option value="">Todos</option>				
				<?php
					include("../../config/db_connection.php");
					$query = "SELECT * FROM servidores 
								where tipo <> 2
								order by nome";
					if (!$result = mysqli_query($db,$query)) {
					exit(mysqli_error());
					}
					if(mysqli_num_rows($result) > 0)
					{
						$number = 1;
						while($row = mysqli_fetch_assoc($result))
						{
						print '<option value="'.$row['id'].'">'.utf8_encode($row['nome']).' ('.$row['ip'].')</option>';		

						}
					}
				?>
							
				</select>					
				</div>
				<div class="form-group">
				<label for=" ">Tipo de ocorrêcia</label>
				<select class="form-control name="search_tipo" id="search_tipo">
				<option value="">Todos</option>		
				<?php
					$query = "SELECT * FROM tipo_problema where id <> 6 order by descricao";
					if (!$result = mysqli_query($db,$query)) {
					exit(mysqli_error());
					}
					if(mysqli_num_rows($result) > 0)
					{
						$number = 1;
						while($row = mysqli_fetch_assoc($result))
						{
						print '<option value="'.$row['id'].'">'.utf8_encode($row['descricao']).'</option>';		

						}
					}
				?>
							
				</select>					
				</div>
				<div class="form-group">
                    <label for="disp">Motivo</label>
                    <input type="text" id="search_motivo" placeholder="Motivo" class="form-control"/>

                </div>
				
				<div class="form-group">
				<div class="col-xs-6">
                 <label for="Inicio">De:</label>
                    <input type="date" id="de" class="form-control"/>
				</div>
				<div class="col-xs-6">
                 <label for="Inicio">Até:</label>
                    <input type="date" id="ate" class="form-control"/>
					<br>
				</div>	
                </div>				
				
				
            </div>

            <div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="searchEvent()">Pesquisar</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>


<!--Modal eventos -->

<div class="modal fade" id="update_event_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Motivo da parada</h4>
            </div>
            <div class="modal-body">
                
				<div class="form-group">
                    <label for="disp">Dispositivo</label>
                    <input type="text" id="dispo" placeholder="Dipositivo" class="form-control" readonly/>
                </div>

                <div class="form-group">
                    <label for="servi">Serviços</label>
                    <input type="text" id="servi" placeholder="Serviços" class="form-control" readonly/>
                </div>
				<div class="form-group">
				<label for=" ">Tipo de ocorrêcia</label>
				<select class="form-control name="tipo_ocorrencia" id="tipo_ocorrencia">
				<?php
					include("../../config/db_connection.php");
					$query = "SELECT * FROM tipo_problema  order by descricao";
					if (!$result = mysqli_query($db,$query)) {
					exit(mysqli_error());
					}
					if(mysqli_num_rows($result) > 0)
					{
						$number = 1;
						while($row = mysqli_fetch_assoc($result))
						{
						print '<option value="'.$row['id'].'">'.utf8_encode($row['descricao']).'</option>';		

						}
					}
				?>
							
				</select>					
				</div>
				<div class="form-group">
                    <label for="disp">Motivo</label>
                    <input type="text" id="motivo" placeholder="Motivo" class="form-control"/>
                </div>				
                <div class="form-group">
                    <label for="descricao">Solução</label>
				<textarea rows="8" cols="50" id="solucao" class="form-control"></textarea>
				</div>				
               
			   <div class="form-group">
				<div class="col-xs-6">
                 <label for="Inicio">Inicio</label>
                    <input type="text" id="inicio" name="inicio" class="form-control" readonly/>
				</div>					<div class="col-xs-6">
                 <label for="Inicio">Fim</label>
                    <input type="datetime-local" id="fim" name="fim" class="form-control"/>
					<br>
				</div>	
                </div>				


<div class="form-group">

	</div>

            </div>
			
            <div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="UpdateEventDetails()">Salvar</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>


<!-- sistema -->	
	<div class="tab-pane" id="sistema">

	<div>
	<table class="table table-bordered table-striped">
	<tr>
	<th>
	
	<?php
	$query = "SELECT * FROM sistema";

	if (!$result = mysqli_query($db,$query)) {
    exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysqli_fetch_assoc($result))
    	{
		$id = $row['id'];		
		$smtp = $row['smtp'];
		$porta_smtp = $row['porta'];
		$user_smtp = $row['usuario'];
		$senha_smtp = $row['senha'];
		
		}
	}		
	?>

				<input type="hidden" value="<?php print $id; ?>" id="smtp_id" name="smtp_id"/> 
				
                <label for="nome">Servidor SMTP</label>
                <input type="text" id="serv_smtp" value="<?php print $smtp; ?>" placeholder="Servidor SMTP" class="form-control" required="required" />
                </div>

                <div class="form-group">
                    <label for="ip">Porta</label>
                    <input type="number" id="porta_smtp" value="<?php print $porta_smtp; ?>" placeholder="Porta"  class="form-control" size="5"/>
                </div>

                <div class="form-group">
                    <label for="ip">Usuário</label>
                    <input type="text" id="user_smtp" value="<?php print $user_smtp; ?>" placeholder="Porta"  class="form-control" size="5"/>
                </div>

                <div class="form-group">
                    <label for="ip">Senha</label>
                    <input type="password" id="senha_smtp" value="<?php print $senha_smtp; ?>" placeholder="Senha"  class="form-control" size="5"/>
                </div>				
     
	 </th>
	</tr>	
	</table>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="UpdateSistema()">Salvar</button>
            </div>	
			
	</div>



	
</div>	
<!-- usuários -->	
	<div class="tab-pane" id="usuarios">

    <div class="row">
        <div class="col-md-12">


            <div class="records_user"></div>
        </div>
    </div>
</div>
<!-- /Content Section -->



<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastrar novo usuário</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome_user" placeholder="Nome" class="form-control" required="required" />
                </div>

                <div class="form-group">
                    <label for="ip">Email</label>
                    <input type="text" id="email_user" placeholder="Email" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="ip">Senha</label>
                    <input type="password" id="senha_user" placeholder="senha" class="form-control"/>
                </div>				
               
			   <div class="form-group">
                    <label for="update_ip">Nível</label>
                 <select class="form-control name="nivel_user" id="nivel_user">
				<option value="1">User</option>	
				<option value="0">Admin</option>
					
				</select>
                </div>				

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord3()">Adicionar Usuário</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="update_nome_user" placeholder="Nome" class="form-control" required="required" />
                </div>

                <div class="form-group">
                    <label for="ip">Email</label>
                    <input type="text" id="update_email_user" placeholder="Email" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="ip">Senha</label>
                    <input type="password" id="update_senha_user" placeholder="senha" class="form-control"/>
                </div>				
               
			   <div class="form-group">
                    <label for="update_ip">Nível</label>
                 <select class="form-control name="update_nivel_user" id="update_nivel_user">
				<option value="1">User</option>	
				<option value="0">Admin</option>
					
				</select>
                </div>				

            </div>			
			
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails3()" >Atualizar</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>

</div>

</div>



<!-- Jquery JS file -->
<script type="text/javascript" src="../assets/js/jquery-1.11.3.min.js"></script>

<!-- Bootstrap JS file -->
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>

<!-- Custom JS file -->
<script type="text/javascript" src="../assets/js/script.js"></script>


<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>
</html>
