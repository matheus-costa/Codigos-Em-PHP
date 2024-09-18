<?php
$conexao = new PDO('sqlite:bancodedados.data');
$sql = "SELECT a.diagostico, a.datahora, 'UPA do Matheus' local
        FROM atendimento a
		JOIN triagem t 
		ON a.triagem = t.id
		JOIN paciente p
		ON t.paciente = p.id
		WHERE p.documento = '$id'";

$resultado = $conexao->query($sql)->fetchAll();
unset($conexao); 

$doc = ['documento' => $doc];
$txt = json_encode($obj);
$curl = curl_init('http://172.26.3.200:8080/historico.php');
curl_setopt($curl, CURLSETOPT_POSTFIELDS,$txt);
curl_setopt($curl, CURLSETOPT_HTTPHEADER, ['Content-type:application/json']);
curl_setopt($curl, CURLSETOPT_RETURNTRANSFER, true);
$txt = curl_exec($curl);
$obj = json_decode($txt, true);
?>
<html>
<head>
    <meta charset='utf-8'>
</head>	
	 <body>
             <table>
				<tr>
                      <th>Data</th>     
					  <th>Diagnostico</th>     
					  <th>Local</th>             
			    </tr>
<?php foreach ($obj as $tupla){ ?>
         <tr>
			<td><?php print $tupla['datahora'];?></td>
			<td><?php print $tupla['diagnostico'];?></td>
			<td><?php print $tupla['local'];?></td>
        </tr>
	<?php } ?>
<?php foreach ($resultado as $tupla){ ?>
			<tr>
			<td><?php print $tupla['datahora'];?></td>
			<td><?php print $tupla['diagnostico'];?></td>
			<td><?php print $tupla['local'];?></td>
        </tr>
    <?php } ?>
       </table>
</body>
</html>