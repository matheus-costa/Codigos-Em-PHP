<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
<?php
		require 'menu.php';
?>
		<form id="cadastro">
			<p><input type="text" name="cpf" placeholder="CPF" autocomplete="off" /></p>
			<p><input type="text" name="nome" placeholder="Nome" autocomplete="off" /></p>
			<p><button type="submit" form="cadastro" formaction="cliente_insert.php" formmethod="post">Cadastrar</button></p>
		</form>
	</body>
</html>
