<?php
    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );

    // a minha variável sql vai retornar o que, o outro sistema espera receber 
    // ele espera receber dados dos estagios do aluno
    // tais como nome e cnpj da empresa
    $sql = "  
            select es.nome, es.cpf, emp.nome, emp.cnpj
            from estudante es

            join aluno a
            on a.estudante = es.id

            join estagio esta
            on esta.empresa = emp.id

            order by em.nome desc;   
    ";
    $conexao = new pdo('sqlite:banco.sqlite');
    $resultado = $conexao->query($sql)->fetchAll(2);
    $obj = [ 'status' => $resultado ];
    $txt = json_encode( $obj );
    print $txt;
    ?>