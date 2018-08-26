<?php
include("login/login.php");
include("config/db_connection.php");
//print '<a href="login/logoff.php">sair</a>';
?>


        <!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Monitor de Status</title>

            <!-- Bootstrap -->
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
            
            <!-- Main Style -->
            <link rel="stylesheet" type="text/css" href="assets/css/main.css">

            <!--Icon Fonts-->
            <link rel="stylesheet" media="screen" href="assets/fonts/font-awesome/font-awesome.min.css" />
                        
          </head>
<br><h1><center><b><font color="white">Monitor de Status</b></center></h1>
        <body>
		
	   	<!-- Pricing Table Section -->
	
        <section id="pricing-table"
            <div class="container">
			 <div class="row">
			 <div class="pricing">
<?php

$query = "SELECT * FROM servidores where tipo = 0
	order by status, INET_ATON(ip)";

	if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysqli_fetch_assoc($result))
    	{
			
			
			
    		
		print '<div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="pricing-table">
                                <div class="pricing-header">
                                    <p class="pricing-title">'.$row['nome'].'</p>';
									
									
			if($row['status'] == 1)	{				
        print '<p class="pricing-rate"><img src="assets/img/on.png" height="90" width="150"/></p><br>'.$row['ip'];
              } 
			else{
			print '<p class="pricing-rate"><img src="assets/img/off.png" height="90" width="150"/></p>';	
			}
         print '</div>';
				$query2 = 'SELECT * FROM servicos where servidor = '.$row['id'].' order by servico ASC';

			if (!$result2 = mysqli_query($query2)) {
			exit(mysqli_error());
			}

			// if query2 results contains rows then featch those rows 
			if(mysqli_num_rows($result2) > 0)
			{
				$number = 1;
				while($row2 = mysqli_fetch_assoc($result2))
				{
										
				if($row2['status'] == 0)
				{
				print '
				<div class="pricing-list">
                <ul>
				<li><i></i><span>'.$row2['servico'].'</span></li>
				</ul>
                </div>';
				}
				else{
					
				}
				}   
			
					$number++;
				}								
									
									
									
									
                                       print '                                
                                   
                            </div>
                        </div>                 
                    
	
			
			';
			
			
			
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	print '<tr><td colspan="6">Nenhum registro encontrado!</td></tr>';
    }

    print '</table>';


?>	
            </div> 
			</div>
			</div>
        </section>
<script language="Javascript">
window.onload = function () {
setTimeout('location.reload();', 100000);
}
</script>
        </body>
        </html>