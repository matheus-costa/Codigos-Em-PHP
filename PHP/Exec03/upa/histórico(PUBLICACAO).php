<?php
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

