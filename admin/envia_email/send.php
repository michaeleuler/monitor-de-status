<?php

include("../../config/db_connection.php");
    $nome_arquivo = 'export';
    header("Content-type: application/vnd.ms-excel");
    header("Content-type: application/force-download");
    header("Content-Disposition: attachment; filename=$nome_arquivo.xls");
    header("Pragma: no-cache");
?>
<table>
    <tr>
        <td>Servidor</td>
        <td>Serviços</td>
        <td>Inicio</td>
		<td>Fim</td>
		<td>Tempo de parada</td>
		
    </tr>
<?php

    $consulta_codigo = mysqli_query("select eventos.id as event_id, servidores.id, servidores.nome, servidores.ip, servicos, motivo, tipo_problema.descricao, 
									date_format(inicio, '%d/%m/%Y' ' às ' '%H:%i') as inicio, date_format(fim, '%d/%m/%Y' ' às ' '%H:%i') as fim,
									concat(TIMESTAMPDIFF (MINUTE, inicio, fim),'H') as tempo_parado, eventos.servidor					from eventos
									INNER JOIN servidores ON eventos.servidor = servidores.id
									INNER JOIN tipo_problema ON eventos.tipo = tipo_problema.id
									order by inicio DESC");
    while($venda = mysqli_fetch_array($consulta_codigo)){
        echo "<tr>
		<td>".$venda['nome']."</td>
		<td>".$venda['servicos']."</td>
		<td>".$venda['inicio']."</td>
		<td>".$venda['fim']."</td>
		<td>".$venda['tempo_parado']."</td>
		
		</tr>";
    }
?>
</table>