<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../../config/db_connection.php");

    // get user id
    $user_id = $_POST['id'];

    // delete User
    $query = "DELETE FROM servicos WHERE id = '$user_id'";
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
}
?>