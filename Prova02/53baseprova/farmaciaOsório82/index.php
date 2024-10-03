<?php

	$conexao = new pdo ('sqlite:banco.sqlite');
	$sql = "
		create table if not exists produto ( id integer primary key autoincrement, anvisa text unique, nome text, valor float );
		create table if not exists cliente ( id integer primary key autoincrement, cpf text unique, nome text );
		create table if not exists venda ( id integer primary key autoincrement, produto integer references produto (id), cliente integer references cliente (id), datahora datetime, valor float );
	";
	$conexao->exec( $sql );
	unset($conexao);
	header('Location: cliente_listar.php');
