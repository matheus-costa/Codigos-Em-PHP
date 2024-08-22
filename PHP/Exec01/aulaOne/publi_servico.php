<?php

$txt = file_get_contents('php://input');//abre arquivos ou conexões, todo o conteúdo da requisição
$obj = json_decode($txt, true);//decodificando o objeto json
$documento = $obj['documento'];//procuro o valor documento dentro da variável OBJ
include 'funcoes.php';//chamo a função e valido como CPF
$teste = validaCPF($documento);
if($teste ){
    $obj = ['status' => true];//verifico se o valor recebido é o já validado CPF
}
else{
    $obj = ['status' =>false];
}
$txt = json_encode($obj); //codifico o resultado do teste em JSON.
print $txt;

