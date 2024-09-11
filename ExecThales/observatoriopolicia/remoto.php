<?php

    $txt = file_get_contents('php://input');
    // { "local":"nome do local", "descricao":"ocorrência de negligência" }
    $obj = json_decode( $txt );
    $local = $obj->local;
    $descricao = $obj->descricao;
    $sql = " insert into ocorrencia values (    null, 
                                                '$local', 
                                                '$descricao', 
                                                datetime('now'), 
                                                null ); ";
    $conexao = new pdo ('sqlite:banco');
    $resultado = $conexao->exec($sql);
    $obj = [ 'status' => false ];
    if ( $resultado > 0 ) {
        $obj = [ 'status' => true ];
    }
    $txt = json_encode($obj);
    print $txt;