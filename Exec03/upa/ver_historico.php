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
				<td><?php print $tupla['datahora']; ?></td>
				<td><?php print $tupla['diaginostico']; ?></td>
                <td><?php print $tupla['']; ?></td>

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

<?php
 $txt = fille_get_contects('http://input');
 $obj = json_decode($txt);
 $nome_upa = $obj -> nome_upa;
 $datahora = $obj -> datahora;
 $diagnostico = $obj -> diagnostico;
 
 $query = "select a.diagnostico, a.datahora, 'upa do miguel' local from atendimento;";
 $conexao = new pdo('sqlite:bancodedados.data');
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
             <td><?php print $tupla['']; ?></td>

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
