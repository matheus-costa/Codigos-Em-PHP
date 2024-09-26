<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$update = "update triagem set celsius = '".$_REQUEST['celsius']."', bpm = '".$_REQUEST['bpm']."', pas = '".$_REQUEST['pas']."', pad = '".$_REQUEST['pad']."', historia = '".$_REQUEST['historia']."', avaliacao = '".$_REQUEST['avaliacao']."', datahora = datetime('now') where id = '".$_REQUEST['triagem']."'; ";
	$resultado = $conexao->exec($update);
	unset($conexao);
	if ( $resultado > 0 ) {
		print 'Inserido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/triagem_lista.php\';}, 2000);</script>';
	} else {
		print 'Erro na inserção.';
	}
?>