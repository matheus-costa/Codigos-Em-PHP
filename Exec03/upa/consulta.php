<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$sql = "SELECT a.diagostico, a.datahora, 'UPA do Miguel' local
        FROM atendimento a
		JOIN triagem t 
		ON a.triagem = t.id
		JOIN paciente p
		ON t.paciente = p.id
		WHERE p.documento = '$doc'";
	$resultado = $conexao->query($sql)->fetchAll();
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
				<th>Ver Histórico</th>
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
				<td><a href="/ver_historico.php?id=<?php print $tupla['id']; ?>">Ver Histórico</a></td>
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