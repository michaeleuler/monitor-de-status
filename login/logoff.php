<?php 

session_start();
 
if (session_destroy()) {
	header("Location: ../index.php");
}
else {
    echo "Não foi possível destruir a sessão";
}
?>