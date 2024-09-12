<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$create = "
		CREATE TABLE if not exists paciente (id integer primary key autoincrement, documento text, nome text, sexo text, nascimento date, email text, fone text, moradia text, copia text, datahora timestamp);
		CREATE TABLE if not exists triagem (id integer primary key autoincrement, paciente integer, celsius integer, bpm integer, pas integer, pad integer, historia text, avaliacao integer, datahora timestamp);
		CREATE TABLE if not exists atendimento (id integer primary key autoincrement, triagem integer, diagnostico text, medicamento text, encaminhamento text, datahora timestamp);
	";
	$conexao->exec($create);
	header('Location:/relatorio_lista.php');
?>
