<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
<?php
	require 'menu.php';
?>
		<form method="post" action="paciente_insert.php">
			<frameset>
				<legend>Cadastro de Paciente</legend>
				<p>
					<input name="documento" type="text" placeholder="CPF ou RG ou Passaporte" autocomplete="off" />
				</p>
				<p>
					<input name="nome" type="text" placeholder="Nome" autocomplete="off" />
				</p>
				<p>
					<select name="sexo">
						<option value="" hidden>Sexo</option>
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
						<option value="I">Não Informado</option>
					</select>
				</p>
				<p>
					<input name="nascimento" type="text" placeholder="Data de Nascimento" onFocus="this.type='date';" autocomplete="off" />
				</p>
				<p>
					<input name="email" type="text" placeholder="e-mail" autocomplete="off" />
				</p>
				<p>
					<input name="fone" type="text" placeholder="Telefone" autocomplete="off" />
				</p>
				<p>
					<input name="moradia" type="text" placeholder="Moradia" autocomplete="off" />
				</p>
				<p>
					<input name="copia" type="text" placeholder="Cópia Documento" onFocus="this.type='file';" autocomplete="off" />
				</p>
				<p>
					<input type="submit" value="Confirmar" />
					<input type="reset" value="Cancelar" />
				</p>
			</frameset>
		</form>
	</body>
</html>