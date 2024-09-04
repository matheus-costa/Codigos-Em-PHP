<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$insert = "insert into atendimento values (null, '".$_REQUEST['triagem']."', '".$_REQUEST['diagnostico']."', '".$_REQUEST['medicamento']."', '".$_REQUEST['encaminhamento']."', datetime('now') );";
	$resultado = $conexao->exec($insert);
	unset($conexao);
	if ( $resultado > 0 ) {
		print 'Inserido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/atendimento_lista.php\';}, 2000);</script>';
	} else {
		print 'Erro na inserção.';
	}
?>