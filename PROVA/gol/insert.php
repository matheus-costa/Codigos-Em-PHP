<?php
	if ( !isset($_REQUEST['entidade']) ) {
		header('Location: /erro.php');
		exit;
	}
	$sql = " select * from ".$_REQUEST['entidade']." limit 1; ";
	$conexao = new pdo ('sqlite:database');
	$conexao->exec("pragma foreign_keys = ON;");
	$meta = $conexao->query( $sql );
	$c = $meta->columnCount();
	$columns = [];
	$values = [];
	for ( $i = 0 ; $i < $c ; $i++ ) {
		if ( in_array ($meta->getColumnMeta($i)['name'], ['id'] ) ) {
			continue;
		}
		$columns[] = $meta->getColumnMeta($i)['name'];
		$values[] = $_REQUEST[$meta->getColumnMeta($i)['name']];
	}
	$sql = " insert into ".$_REQUEST['entidade']." (".implode(", ", $columns).") values ('".implode("', '", $values)."'); ";
	print $sql;
	$resultado = $conexao->exec($sql);
	if ( $resultado == 0 ) {
		print 'Erro.';
		exit;
	}
	unset($conexao);
	header('Location: /lista.php?entidade='.$_REQUEST['entidade'].'&rotulo='.$_REQUEST['rotulo'].(isset($_REQUEST['view']) ? '&view' : ''));