<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$pesquisa = "select t.id, p.documento, p.nome, p.sexo, p.nascimento from triagem t join paciente p on p.id = t.paciente where t.id = '".$_REQUEST['id']."' and t.avaliacao is null ";
	$resultado = $conexao->query($pesquisa)->fetchAll();
	$tupla = $resultado[0];
?>
<html>
	<head>
	</head>
	<body>
		<?php
			require 'menu.php';
		?>
		<table>
			<caption>Dados do Paciente</caption>
			<tr>
				<th>Triagem</th>
				<td><?php print $tupla['id']; ?></td>
			</tr>
			<tr>
				<th>Nome</th>
				<td><?php print $tupla['nome']; ?></td>
			</tr>
			<tr>
				<th>Sexo</th>
				<td><?php print $tupla['sexo']; ?></td>
			</tr>
			<tr>
				<th>Nascimento</th>
				<td><?php print $tupla['nascimento']; ?></td>
			</tr>
		</table>
		<br/>
		<form method="post" action="triagem_update.php">
			<input type="hidden" name="triagem" value="<?php print $tupla['id']; ?>" />
			<frameset>
				<legend>Cadastro de Triagem</legend>
				<p>
					<input name="celsius" type="number" placeholder="Temperatura" step="0.1" autocomplete="off" />
				</p>
				<p>
					<input name="bpm" type="number" placeholder="Frequência Cardíaca" autocomplete="off" />
				</p>
				<p>
					<input name="pas" type="number" placeholder="Pressão Arterial Sistólica" autocomplete="off" />
				</p>
				<p>
					<input name="pad" type="number" placeholder="Pressão Arterial Diastólica" autocomplete="off" />
				</p>
				<p>
					<input name="historia" type="text" placeholder="História do Paciente" autocomplete="off" />
				</p>
				<p>
					<select name="avaliacao" required>
						<option value="" hidden>Avaliação de Risco</option>
						<option value="3">Alto</option>
						<option value="2">Médio</option>
						<option value="1">Baixo</option>
						<option value="0">Eletivo</option>
					</select>
				</p>
				<p>
					<input type="submit" value="Confirmar" />
					<input type="reset" value="Cancelar" />
				</p>
			</frameset>
		</form>
	</body>
</html>