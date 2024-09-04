<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$pesquisa = "select t.id, t.avaliacao, p.documento, p.nome, p.sexo, ( (strftime('%Y', 'now') - strftime('%Y', p.nascimento)) - (strftime('%m-%d', 'now') < strftime('%m-%d', p.nascimento))) idade from triagem t join paciente p on p.id = t.paciente where t.avaliacao is not null and (select count(*) from atendimento where triagem = t.id) = 0 order by t.avaliacao desc, p.datahora; ";
	$resultado = $conexao->query($pesquisa)->fetchAll();
	unset($conexao);
	if ( count($resultado) == 0 ) {
		require 'menu.php';
		print 'Parabéns! Não há atendimentos pendentes.';
		print '<script>window.setTimeout(function(){window.location=\'/atendimento_lista.php\';}, 2000);</script>';
	} else {
?>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php require 'menu.php'; ?>
		<table border="1">
			<caption>Atendimentos Pendentes</caption>
			<tr>
				<th>Documento</th>
				<th>Nome</th>
				<th>Sexo</th>
				<th>Idade</th>
				<th>Avaliação de Risco</th>
				<th></th>
			</tr>
<?php
		foreach ( $resultado as $tupla ) {
			$tupla['avaliacao'] = [ 'Eletivo', 'Baixo', 'Médio', 'Alto' ][$tupla['avaliacao']];
?>
			<tr>
				<td><?php print $tupla['documento']; ?></td>
				<td><?php print $tupla['nome']; ?></td>
				<td><?php print $tupla['sexo']; ?></td>
				<td><?php print $tupla['idade']; ?></td>
				<td><?php print $tupla['avaliacao']; ?></td>
				<td><a href="/atendimento_cadastro.php?id=<?php print $tupla['id']; ?>">Atender</a></td>
			</tr>
<?php
		}
?>
		</table>
	</body>
</html>
<?php
	}
?>