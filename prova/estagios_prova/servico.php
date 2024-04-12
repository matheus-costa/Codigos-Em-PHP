<?php

    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );
    $cpf = $obj['cpf'];
    $consulta = " select em.*
    from estudante e
    join aluno a
        on a.estudante = e.id
    join estagio eg
        on a.id = eg.aluno
    join empresa em
        on eg.empresa = em.id
    where e.cpf = '$cpf' ";
    $conexao = new pdo ('sqlite:database');
    $resultado = $conexao->query($consulta)->fetchAll(2);
    $txt = json_encode( $resultado );
    print $txt;
    