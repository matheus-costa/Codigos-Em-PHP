<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$pesquisa = "select a.id, t.avaliacao, p.documento, p.nome, p.sexo, p.nascimento, a.diagnostico, a.medicamento, a.encaminhamento from triagem t join paciente p on p.id = t.paciente join atendimento a on a.triagem = t.id order by a.id desc; ";
	if ( isset($_REQUEST['pesquisa']) ) {
		$pesquisa = "select a.id, t.avaliacao, p.documento, p.nome, p.sexo, p.nascimento, a.diagnostico, a.medicamento, a.encaminhamento from triagem t join paciente p on p.id = t.paciente join atendimento a on a.triagem = t.id where p.nome like '%".$_REQUEST['pesquisa']."%' or a.diagnostico like '%".$_REQUEST['pesquisa']."%' or a.medicamento like '%".$_REQUEST['pesquisa']."%' or a.encaminhamento like '%".$_REQUEST['pesquisa']."%' order by a.id desc; ";
	}
	$resultado = $conexao->query($pesquisa)->fetchAll();
	unset($conexao);
?>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php require 'menu.php'; ?>
		<form method="post">
			<frameset>
				<caption>Pesquisa</caption>
				<input type="text" name="pesquisa" />
				<input type="submit" value="Pesquisar" />
			</frameset>
		</form>
		<table border="1">
			<caption>Relatório de Atendimentos Concluídos</caption>
			<tr>
				<th>Registro</th>
				<th>Nome</th>
				<th>Sexo</th>
				<th>Nascimento</th>
				<th>Avaliação de Risco</th>
				<th>Diagnóstico</th>
				<th>Medicamentos</th>
				<th>Encaminhamento</th>
			</tr>
<?php
		foreach ( $resultado as $tupla ) {
			$tupla['avaliacao'] = [ 'lightBlue', 'green', 'yellow', 'red' ][$tupla['avaliacao']];
?>
			<tr>
				<td><?php print $tupla['id']; ?></td>
				<td><?php print $tupla['nome']; ?></td>
				<td><?php print $tupla['sexo']; ?></td>
				<td><?php print $tupla['nascimento']; ?></td>
				<td style="background-color: <?php print $tupla['avaliacao']; ?>"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
				<td><?php print $tupla['diagnostico']; ?></td>
				<td><?php print $tupla['medicamento']; ?></td>
				<td><?php print $tupla['encaminhamento']; ?></td>
			</tr>
<?php
		}
?>
		</table>
	</body>
</html>