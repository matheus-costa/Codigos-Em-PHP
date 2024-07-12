<?php
    $sql = "select id, nome, cpf from cliente;";
    $conexao = new pdo ('sqlite:tab');
    $resultado = $conexao->query($sql)->fetchAll(2);
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
        <p>A assinatura analisada não pôde ser autenticada. Por favor, tente novamente.</p>
    </body>
</html>