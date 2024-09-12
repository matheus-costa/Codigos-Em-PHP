<?php

$conexao = new pdo('sqlite:bancodedados.data');
$pesquisa = "select t.id, t.avaliacao, p.documento, p.nome, p.sexo, ( (strftime('%Y', 'now') - strftime('%Y', p.nascimento)) - (strftime('%m-%d', 'now') < strftime('%m-%d', p.nascimento))) idade from triagem t join paciente p on p.id = t.paciente where t.avaliacao is not null and (select count(*) from atendimento where triagem = t.id) = 0 order by t.avaliacao desc, p.datahora; ";
$resultado = $conexao->query($pesquisa)->fetchAll();
unset($conexao);
if ( count($resultado) == 0 ) {
	require 'menu.php';
	print 'Parabéns! Não há atendimentos pendentes.';
	print '<script>window.setTimeout(function(){window.location=\'/atendimento_lista.php\';}, 2000);</script>';
}
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
				<th>Nome da UPA</th>
				<th>Data Atendimento</th>
				<th>Diagnostico</th>
				<th>Nome do Paciente</th>
			</tr>
<?php
		foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['']; ?></td>
				<td><?php print $tupla['']; ?></td>
				<td><?php print $tupla['']; ?></td>
                <td><?php print $tupla['nome']; ?></td>

			</tr>
<?php
		}
?>
		</table>
	</body>
</html>

<?php
//PUBLICAÇÃO DO SERVIÇO SEGUNDO O THALES
//php -S 0.0.0.0:8081 usado para que a minha máquina fique visível para outras máquinas
//127.0.0.1 é o meu localhost
//ip a para ver o do PC
$txt = fille_get_contects('php://input');
$obj = json_decode($txt);
$doc = $obj -> documento;
$sql = "SELECT a.diagostico, a.datahora, 'UPA do Miguel' local
        FROM atendimento a
		JOIN triagem t 
		ON a.triagem = t.id
		JOIN paciente p
		ON t.paciente = p.id
		WHERE p.documento = '$doc'";

$conexao = new pdo('sqlite:bancodedados.data');		
$resultado = query($sql)->fetchAll(2);
$txt = json_encode($resultado);
print $txt;
