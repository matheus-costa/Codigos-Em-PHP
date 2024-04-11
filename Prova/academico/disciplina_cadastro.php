<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>Cadastro de Disciplina</h1>
		<form id="form">
			<p> <input type="text" name="nome" placeholder="Nome da Disciplina" autocomplete="off" /> </p>
			<select name="professor">
				<option hidden> Professor </option>
			<?php
				$conexao = new pdo ('sqlite:banco.sqlite');
				$select = "select id, nome from professor order by nome";
				$resultado = $conexao->query($select)->fetchAll();
				foreach ( $resultado as $tupla ) {
			?>
				<option value="<?php print $tupla['id']; ?>"><?php print $tupla['nome']; ?></option>
			<?php
				}
				unset($conexao);
			?>
			</select>
			<p> <button for="form" type="submit" formmethod="post" formaction="disciplina_insert.php"> Cadastrar </button> </p>
		</form>
	</body>
</html>