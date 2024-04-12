<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>Cadastro de Matrícula</h1>
		<form id="form">
			<p>
				<select name="aluno">
					<option hidden> Aluno </option>
				<?php
					$conexao = new pdo ('sqlite:banco.sqlite');
					$select = "select id, nome from aluno order by nome";
					$resultado = $conexao->query($select)->fetchAll();
					foreach ( $resultado as $tupla ) {
				?>
					<option value="<?php print $tupla['id']; ?>"><?php print $tupla['nome']; ?></option>
				<?php
					}
					unset($conexao);
				?>
				</select>
			</p>
			<p>
				<select name="disciplina">
					<option hidden> Disciplina </option>
				<?php
					$conexao = new pdo ('sqlite:banco.sqlite');
					$select = "select d.id, d.nome dnome, p.nome pnome from disciplina d join professor p on p.id = d.professor order by d.nome";
					$resultado = $conexao->query($select)->fetchAll();
					foreach ( $resultado as $tupla ) {
				?>
					<option value="<?php print $tupla['id']; ?>"><?php print $tupla['dnome']; ?> (<?php print $tupla['pnome']; ?>)</option>
				<?php
					}
					unset($conexao);
				?>
				</select>
			</p>
			<p> <button for="form" type="submit" formmethod="post" formaction="matricula_insert.php"> Cadastrar </button> </p>
		</form>
	</body>
</html>