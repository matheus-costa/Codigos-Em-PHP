<?php

    $id = $_REQUEST['id'];
    $sql = "delete from cliente where id = '$id'; ";
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
            <p>Cliente removido com sucesso.</p>
        <?php } else { ?>
            <p>Não foi possível remover o cliente. Tente novamente.</p>
        <?php } ?>
    </body>
</html>