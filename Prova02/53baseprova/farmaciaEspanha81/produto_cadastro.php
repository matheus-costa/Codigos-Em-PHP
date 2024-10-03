<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
<?php
		require 'menu.php';
?>
		<form id="cadastro">
			<p><input type="text" name="anvisa" placeholder="ANVISA" autocomplete="off" /></p>
			<p><input type="text" name="nome" placeholder="Nome" autocomplete="off" /></p>
			<p><input type="number" name="valor" placeholder="Valor" step="0.01" min="0" /></p>
			<p><button type="submit" form="cadastro" formaction="produto_insert.php" formmethod="post">Cadastrar</button></p>
		</form>
	</body>
</html>
