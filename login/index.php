<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Status - TI |Alumipack</title>

    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"/>
</head>
<body>

<body>


    <div class="container-fluid">    
        <div id="loginbox" style="margin-top:100px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">Status - TI | Alumipack</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Esqueceu a senha?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="index.php">
						<?php
include("../config/db_connection.php");

if (isset($_POST["email"]) && isset($_POST["email"])) {
$email = $_POST['email'];
$pass = md5($_POST['pass']);


	$query = "select * from user where email = '$email' and senha ='$pass'";

		if (!$result = mysqli_query($db,$query)) {
			exit(mysqli_error());
			}

		// if query results contains rows then featch those rows 
		if(mysqli_num_rows($result) > 0)
		{
			session_start();
			$number = 1;
			while($row = mysqli_fetch_assoc($result))
			{	
			$id = $row['id'];
			$nome = $row['nome'];
			$nivel = $row['nivel'];
			
			
			$_SESSION['id'] = $id;
			$_SESSION['nome'] = $nome;
			$_SESSION['nivel'] = $nivel;
			$_SESSION["logado"] = TRUE;
			
			if($nivel == 0)
				{
					header("Location: ../admin/index.php");
				}
    		$number++;
			}
		}
		else {
				print  '<div class="alert alert-danger" role="alert">
						<strong>Usuário ou senha incorretos!</strong><br>Tete novamente.
						</div>';
			}

}		
else {
$email = '';
$pass = '';
}

		
?>
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="email" type="text" class="form-control" name="email" value="" placeholder="E-mail">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="pass" type="password" class="form-control" name="pass" placeholder="Senha">
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Lembrar
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">

									   <input class="btn btn-success" type="submit" value="Login" />


                                    </div>
                                </div>

                                    </div>
                                </div>    
                            </form>     



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


</body>
</html>
