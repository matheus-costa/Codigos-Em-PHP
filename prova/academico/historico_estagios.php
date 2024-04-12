<?php
	$curl = curl_init('http://localhost:8082/servico.php');
	$obj = ["cpf" => $_REQUEST['cpf']];
	$txt = json_encode($obj);
	curl_setopt( $curl, CURLOPT_POSTFIELDS, $txt );
	curl_setopt( $curl, CURLOPT_HTTPHEADER, [ 'Content-type:application/json' ] );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
	$txt = curl_exec($curl);
	$obj = json_decode($txt, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php include 'menu.php'; ?>
	<h1>Histórtico de estágios </h1>
	<table border="1">

		<tr>
		<td>id</td>
		<td>nome</td>
		<td>cnpj</td>
		</tr>
		<?php foreach ($obj as $tupla){?>
			<tr>
				<td><?php echo $tupla['id'] ?></td>
				<td><?php echo $tupla['nome'] ?></td>
				<td><?php echo $tupla['cnpj'] ?></td>
			<?php
		}
		?>
		</table>
</body>
</html>

 
