<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>Lista de Alunos</h1>
		<table border="1">
<?php
	$select = "select id, nome, cpf from aluno order by nome";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->query($select)->fetchAll();
	unset($conexao);
	foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['id']; ?></td>
				<td><?php print $tupla['nome']; ?></td>
				<td><?php print $tupla['cpf']; ?></td>
				<td><a href="aluno_remover.php?id=<?php print $tupla['id']; ?>">X</a></td>
				<td><a href="historico_estagios.php?cpf=<?php print $tupla['cpf']; ?>">Histórico de estágios</a></td>
				
			</tr>
<?php
	}
?>
		</table>
	</body>
</html>