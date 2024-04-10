<?php
	if ( !isset($_REQUEST['entidade']) ) {
		print 'Erro.';
		exit;
	}
	$sql = " delete from ".$_REQUEST['entidade']." where id = '".$_REQUEST['id']."'; ";
	$conexao = new pdo ('sqlite:database');
	$conexao->exec("pragma foreign_keys = ON;");
	$resultado = $conexao->exec($sql);
	unset($conexao);	
	if ( $resultado == 0 ) {
		print 'Erro.';
		exit;
	}
	header('Location: /lista.php?entidade='.$_REQUEST['entidade'].'&rotulo='.$_REQUEST['rotulo'].(isset($_REQUEST['view']) ? 'view' : ''));