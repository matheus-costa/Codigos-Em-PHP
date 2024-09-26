<?php

    $local = $_REQUEST['local'];
    $descricao = $_REQUEST['descricao'];
    $sql = " insert into ocorrencia values (null, '$local', '$descricao', datetime('now'), null); ";
    $conexao = new pdo('sqlite:banco');
    $conexao->exec($sql);
    unset($conexao);
    header('Location: lista.php');