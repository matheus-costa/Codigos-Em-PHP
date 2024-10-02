<?php
	$busca = '';
	if ( isset( $_REQUEST['busca'] ) ) {
		$busca = $_REQUEST['busca'];
	}
	$sql = " select id, anvisa, nome, valor from produto where anvisa || nome like '%" . $busca . "%' order by nome; ";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->query($sql)->fetchAll();
	unset($conexao);
?>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
<?php
		require 'menu.php';
?>
		<form id="busca">
			<p>
				<input type="text" name="busca" autocomplete="off" />
				<button type="submit" formmethod="post" formaction="produto_listar.php">Buscar</button>
			</p>
		</form>
		<table border="1">
			<tr>
				<td>#</td>
				<td>ANVISA</td>
				<td>Nome</td>
				<td>Valor</td>
				<td>Remover</td>
			</tr>
<?php
	foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['id']; ?></td>
				<td><?php print $tupla['anvisa']; ?></td>
				<td><?php print $tupla['nome']; ?></td>
				<td><?php print $tupla['valor']; ?></td>
				<td><a href="produto_delete.php?id=<?php print $tupla['id']; ?>"> X </a></td>
			</tr>
<?php
	}
?>
		</table>
	</body>
</html>
