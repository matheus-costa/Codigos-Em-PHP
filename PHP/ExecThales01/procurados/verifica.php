<?php

    $txt = file_get_contents('php://input');//PEGO O QUE VEM PELO INPUT QUE É O PACIENTE INSERT
    $obj = json_decode( $txt, true );//CODIFICO O OBJETO
    $doc = $obj['doc'];//PEGO A VARÁVEL DOC
    $conexao = new pdo('sqlite:db');
    $sql = " select * from pessoa where cpf = '$doc'; ";// PROCURO ESTE DOCUMENTO NO MEU DB
    $resultado = $conexao->query($sql)->fetchAll();
    $obj = [ 'procurado' => false ];//DECLARO O OBJ COMO FALSE
    if ( count($resultado) > 0 ) {//PROCURO A CONTAGEM DE REGISTROS PARA ESTE DOC
        $obj = [ 'procurado' => true ];// SE FOR TRUE O DOCUMENTO DA PESSOA ESTÁ SENDO PROCURADO
    }
    $txt = json_encode( $obj );
    print $txt;