<?php

    $nome = $_REQUEST['nome'];
    $cpf = $_REQUEST['cpf'];
    $sql = "insert into cliente values (null, '$nome', '$cpf', null); ";
    $conexao = new pdo('sqlite:tab');
    $resultado = $conexao->exec($sql);
    unset($conexao);
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="tabelionato.css" />
    </head>
    <body>
        <p>
            <a href="listacliente.php">Cliente</a>
        </p>
        <?php if ( $resultado > 0 ) { ?>
            <p>Cliente inserido com sucesso.</p>
        <?php } else { ?>
            <p>Não foi possível inserir o cliente. Tente novamente.</p>
        <?php } ?>
    </body>
</html>