<?php

    $sql = "
        create table if not exists ocorrencia (
            id integer primary key autoincrement,
            local text,
            descricao text,
            criacao datetime,
            resposta datetime
        );
    ";
    $conexao = new pdo('sqlite:banco');
    $conexao->exec($sql);
    unset($conexao);
    header('Location: lista.php');
