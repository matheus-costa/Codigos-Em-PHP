<?php
	$busca = '';
	if ( isset( $_REQUEST['busca'] ) ) {
		$busca = $_REQUEST['busca'];
	}
	$sql = " select v.id, p.anvisa, p.nome pnome, p.valor pvalor, c.cpf, c.nome cnome, v.valor vvalor from venda v join cliente c on c.id = v.cliente join produto p on p.id = v.produto where p.nome || c.nome like '%" . $busca . "%' ";
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
				<button type="submit" formmethod="post" formaction="venda_listar.php">Buscar</button>
			</p>
		</form>
		<table border="1">
			<tr>
				<td>#</td>
				<td>Produto</td>
				<td>Valor Produto</td>
				<td>Cliente</td>
				<td>Valor Venda</td>
				<td>Remover</td>
			</tr>
<?php
	foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['id']; ?></td>
				<td><?php print $tupla['pnome']; ?></td>
				<td><?php print $tupla['pvalor']; ?></td>
				<td><?php print $tupla['cnome']; ?></td>
				<td><?php print $tupla['vvalor']; ?></td>
				<td><a href="venda_delete.php?id=<?php print $tupla['id']; ?>"> X </a></td>
			</tr>
<?php
	}
?>
		</table>
	</body>
</html>
