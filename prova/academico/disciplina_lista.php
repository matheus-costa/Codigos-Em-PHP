<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>Lista de Disciplinas</h1>
		<table border="1">
<?php
	$select = "select d.id, d.nome dnome, p.nome pnome from disciplina d join professor p on p.id = d.professor order by d.nome";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->query($select)->fetchAll();
	unset($conexao);
	foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['id']; ?></td>
				<td><?php print $tupla['dnome']; ?></td>
				<td><?php print $tupla['pnome']; ?></td>
				<td><a href="disciplina_remover.php?id=<?php print $tupla['id']; ?>">X</a></td>
			</tr>
<?php
	}
?>
		</table>
	</body>
</html>