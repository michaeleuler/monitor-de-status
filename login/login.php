<?php 
//INICIO A SESS�O
session_start();

//Verifico se o usu�rio est� logado no sistema
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE) {
    header("Location: login/index.php");
}
else {
 //z   echo "<h1>Seja bem-vindo, ".$_SESSION["nivel"]."</h1>";
}

?>