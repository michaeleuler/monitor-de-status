<?php 

session_start();
 
if (session_destroy()) {
	header("Location: ../index.php");
}
else {
    echo "N�o foi poss�vel destruir a sess�o";
}
?>