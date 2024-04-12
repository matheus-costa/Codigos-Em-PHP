<?php

	$sql = "
		pragma foreign_keys = on;
		create view if not exists vvoo as select v.id, a.matricula || a.fabricante || a.modelo as aviao, o.iata origem, d.iata destino, v.datahora from voo v join aviao a on a.id = v.aviao join destino o on v.origem = o.id join destino d on v.destino = d.id; 
		create view if not exists vpassageiro as select v.*, c.cpf, c.nome from passageiro p join vvoo v on v.id = p.voo join cliente c on c.id = p.cliente;
		create table if not exists estudante ( id integer primary key autoincrement, nome text not null, cpf text unique not null );
		create table if not exists instituicao ( id integer primary key autoincrement, nome text not null, emec text unique not null );
		create table if not exists aluno ( id integer primary key autoincrement, estudante integer references estudante (id) not null, instituicao integer references instituicao (id) not null );
		create table if not exists empresa ( id integer primary key autoincrement, nome text not null, cnpj text unique not null );
		create table if not exists estagio ( id integer primary key autoincrement, aluno integer references aluno (id) not null, empresa integer references empresa (id) not null );
		create view if not exists valuno as select a.id, e.nome enome, e.cpf, i.nome inome, i.emec from aluno a join estudante e on a.estudante = e.id join instituicao i on i.id = a.instituicao order by a.id;
		create view if not exists vestagio as select g.id, a.enome anome, a.cpf, m.nome mnome, m.cnpj from estagio g join valuno a on a.id = g.aluno join empresa m on m.id = g.empresa order by g.id;
	";
	$conexao = new pdo ( 'sqlite:database' );
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$resultado = $conexao->exec( $sql );
	//var_dump($resultado); exit;
	header ( 'Location: lista.php?entidade=aluno&rotulo=Aluno&view' );