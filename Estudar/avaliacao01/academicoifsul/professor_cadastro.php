<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>Cadastro de Professor</h1>
		<form id="form">
			<p> <input type="text" name="nome" placeholder="Nome do Professor" autocomplete="off" /> </p>
			<p> <button for="form" type="submit" formmethod="post" formaction="professor_insert.php"> Cadastrar </button> </p>
		</form>
	</body>
</html>