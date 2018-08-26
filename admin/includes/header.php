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
            <h1>Console administrativo 
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

	<li class="active"><a href="#status" data-toggle="tab"><span class="glyphicon glyphicon-stats"></span> Status </a></li>		
	<li><a href="#servidores" data-toggle="tab"><span class="glyphicon glyphicon-hdd"> 	Dispositivos</a></li>
	<li><a href="#servicos" data-toggle="tab"><span class="glyphicon glyphicon-th-large"></span> Serviços</a></li>
	<li><a href="#sistema" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Sistema </a></li>	
	<li><a href="#usuarios" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Usuários </a></li>	
			<?php 
			
$url = 'http://192.168.1.36';
$dadosSite = file_get_contents($url);
if ($dadosSite <=15){			
print '<div class="text-right">
<button type="button" class="btn btn-default">';
print '<b><i class="fa fa-thermometer-quarter" aria-hidden="true"></i></i>'.$dadosSite.'°C</b>';
}
else {			
print '<div class="text-right">
<button type="button" class="btn btn-danger">';
print '<b>'.$dadosSite.'°C</b>';
}
?>
			</button>
        </div>	 
</ul>

<div class="tab-content">