<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>Cadastro de Aluno</h1>
		<form id="form">
			<p> <input type="text" name="nome" placeholder="Nome do Aluno" autocomplete="off" /> </p>
			<p> <input type="text" name="cpf" placeholder="CPF do Aluno" autocomplete="off" /> </p>
			<p> <button for="form" type="submit" formmethod="post" formaction="aluno_insert.php"> Cadastrar </button> </p>
		</form>
	</body>
</html>