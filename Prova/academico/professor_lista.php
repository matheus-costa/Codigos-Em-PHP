<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>Lista de Professores</h1>
		<table border="1">
<?php
	$select = "select id, nome from professor order by nome";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->query($select)->fetchAll();
	unset($conexao);
	foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['id']; ?></td>
				<td><?php print $tupla['nome']; ?></td>
				<td><a href="professor_remover.php?id=<?php print $tupla['id']; ?>">X</a></td>
			</tr>
<?php
	}
?>
		</table>
	</body>
</html>