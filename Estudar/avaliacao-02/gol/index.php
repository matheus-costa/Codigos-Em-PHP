<?php

	$sql = "
		pragma foreign_keys = on;
		create table if not exists aviao ( id integer primary key autoincrement, matricula text, fabricante text, modelo text, ano text, capacidade integer );
		create table if not exists destino ( id integer primary key, iata text, nome text );
		create table if not exists voo ( id integer primary key autoincrement, origem integer references destino (id), destino integer references destino (id), aviao integer references aviao (id), datahora datetime, preco float );
		create table if not exists cliente ( id integer primary key autoincrement, cpf text, nome text );
		create table if not exists passageiro ( id integer primary key autoincrement, voo integer references voo (id), cliente integer references cliente (id) );
		create view if not exists vvoo as select v.id, 'Gol ' || v.id voo, a.matricula || a.fabricante || a.modelo as aviao, o.iata origem, d.iata destino, v.datahora from voo v join aviao a on a.id = v.aviao join destino o on v.origem = o.id join destino d on v.destino = d.id; 
		create view if not exists vpassageiro as select v.*, c.cpf, c.nome from passageiro p join vvoo v on v.id = p.voo join cliente c on c.id = p.cliente;
	";
	$conexao = new pdo ( 'sqlite:database' );
	$resultado = $conexao->exec( $sql );
	header ( 'Location: lista.php?entidade=voo&rotulo=Voo&view' );