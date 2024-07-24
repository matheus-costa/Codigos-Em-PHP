<div class="cabecalho">
	<div><b>IFRN</b></div>
	<div class="menu">
		<a href="aluno_lista.php">Alunos</a>
		<div class="submenu">
			<div><a href="aluno_lista.php">Listar</a></div>
			<div><a href="aluno_cadastro.php">Cadastrar</a></div>
		</div>
	</div>
	<div class="menu">
		<a href="professor_lista.php">Professores</a>
		<div class="submenu">
			<div><a href="professor_lista.php">Listar</a></div>
			<div><a href="professor_cadastro.php">Cadastrar</a></div>
		</div>
	</div>
	<div class="menu">
		<a href="disciplina_lista.php">Disciplinas</a>
		<div class="submenu">
			<div><a href="disciplina_lista.php">Listar</a></div>
			<div><a href="disciplina_cadastro.php">Cadastrar</a></div>
		</div>
	</div>
	<div class="menu">
		<a href="matricula_lista.php"> Matrículas</a>
		<div class="submenu">
			<div><a href="matricula_lista.php">Listar</a></div>
			<div><a href="matricula_cadastro.php">Cadastrar</a></div>
			<div><a href="nota_lista.php">Listar Notas</a></div>
		</div>
	</div>
	<style>
		.menu { width: 120px; position: relative; float: left; }
		.submenu { position: absolute; top: 20px; display: none; }
		.menu:hover .submenu { display: block; }
		.cabecalho { padding-bottom: 30px; }
	</style>
</div>