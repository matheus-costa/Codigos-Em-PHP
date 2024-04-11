<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>Lista de Notas</h1>
		<table border="1">
<?php
	$select = "select m.id, a.nome anome, d.nome dnome, p.nome pnome, m.conceito from matricula m join aluno a on a.id = m.aluno join disciplina d on d.id = m.disciplina join professor p on p.id = d.professor order by d.nome";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->query($select)->fetchAll();
	unset($conexao);
	foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['id']; ?></td>
				<td><?php print $tupla['anome']; ?></td>
				<td><?php print $tupla['dnome']; ?></td>
				<td><?php print $tupla['pnome']; ?></td>
				<td style="background-color: <?php switch($tupla['conceito']){case'A':print'lightgreen';break;case'R':print'tomato';break;} ?>;"><?php print $tupla['conceito']; ?></td>
				<td><a href="nota_update.php?id=<?php print $tupla['id']; ?>&nota=A">Aprovar</a></td>
				<td><a href="nota_update.php?id=<?php print $tupla['id']; ?>&nota=R">Reprovar</a></td>
				<td><a href="nota_update.php?id=<?php print $tupla['id']; ?>&nota=I">X</a></td>
			</tr>
<?php
	}
?>
		</table>
	</body>
</html>