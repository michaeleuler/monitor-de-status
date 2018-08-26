<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../../config/db_connection.php");

    // get user id
    $user_id = $_POST['id'];

    // delete User
    $query = "
	DELETE FROM servidores, servicos
	USING servidores, servicos
	WHERE servidores.id = $user_id
	AND servicos.servidor = $user_id";
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
}
print $_POST['id'];
?>
