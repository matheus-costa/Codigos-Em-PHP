<?php

$txt = file_get_contents('php://input');
$obj = json_decode($txt, true);
$sql = "select v.origem, v.destino from vvoo" . ";";
$conexao = new pdo('sqlite:banco');
$resultado = $conexao->query($sql)->fetchAll(2);
$conteudo = $resultado['v.origem']['v.destino'];
$obj = ["v.origem", "v.destino" => $conteudo];
$txt = json_encode($obj);
print $txt;