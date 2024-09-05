<?php
$txt = file_get_contents('php://input');//ABRINDO A REQUISIÇÃO
//ESPERA-SE RECEBER UM JSON COM ÍNDICE LOCAL E UMA DESCRICAO(QUE VAI TER UM TEXTO)
$obj = json_decode($txt);//objeto válido
$local = $obj -> local;//objeto vindo de quem consome o servico
$descricao = $obj -> descricao;//objeto vindo de quem consome o servico

$sql = "insert into ocorrencia values (null, '$local', '$descricao', datetime('now'), null)";//sql de uma ocorrência que não foi cadastrada
$conexao = new pdo('sqlite:banco');
$resultado = $conexao->exec($sql);
$obj =['status' => false];
if($resultado > 0){
    $obj = ['status' => true];
}
$txt = json_encode($obj);
error_log($txt);
print $txt;