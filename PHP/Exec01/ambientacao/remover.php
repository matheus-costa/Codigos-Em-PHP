<?php

    $cpf = $_REQUEST['cpf'];
    $conexao = new pdo ('sqlite:banco');
    $delete = "delete from pessoa where cpf = '$cpf'; ";
    $resultado = $conexao->exec($delete);
    if ( $resultado > 0 ) {
        //print 'Removido com sucesso';
        header('Location:lista.php');
    } else {
        print 'Erro na remoção.';
    }