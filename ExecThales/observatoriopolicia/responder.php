<?php

    $id = $_REQUEST['id'];
    $sql = " update ocorrencia set resposta = datetime('now') where id = '$id'; ";
    $conexao = new pdo('sqlite:banco');
    $conexao->exec($sql);
    unset($conexao);
    header('Location: lista.php');