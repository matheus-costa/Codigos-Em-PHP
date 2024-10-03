<?php
	$sqlc = " select id, nome from cliente order by nome; ";
	$sqlp = " select id, nome from produto order by nome; ";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultadoc = $conexao->query($sqlc)->fetchAll();
	$resultadop = $conexao->query($sqlp)->fetchAll();
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
		<form id="cadastro">
			<p>
				<select name="cliente">
					<option hidden>Selecione o Cliente</option>
	<?php
		foreach ( $resultadoc as $tupla ) {
	?>
					<option value="<?php print $tupla['id']; ?>"><?php print $tupla['nome']; ?></option>
	<?php
		}
	?>
				</select>
			</p>
			<p>
				<select name="produto">
					<option hidden>Selecione o Produto</option>
	<?php
		foreach ( $resultadop as $tupla ) {
	?>
					<option value="<?php print $tupla['id']; ?>"><?php print $tupla['nome']; ?></option>
	<?php
		}
	?>
				</select>
			</p>
			<p><button type="submit" form="cadastro" formaction="venda_insert.php" formmethod="post">Cadastrar</button></p>
		</form>
	</body>
</html>

