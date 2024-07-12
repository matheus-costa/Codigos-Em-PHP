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
        <h2>Lista de Clientes</h2>
        <table border="1">
            <?php foreach( $resultado as $tupla ) { ?>
                <tr>
                    <td><?php print $tupla['id']; ?></td>
                    <td><?php print $tupla['cpf']; ?></td>
                    <td><?php print $tupla['nome']; ?></td>
                    <td><a href="removecliente.php?id=<?php print $tupla['id']; ?>">&#9746;</a></td>
                    <td><a href="autenticacliente.php?id=<?php print $tupla['id'] ?>&repositorioid=<?php print $tupla['repositorioid']; ?>">&#9745;</a></td>
                    <td><a href="listaarquivo.php?cliente=<?php print $tupla['id'] ?>">&#9783;</a></td>
                </tr>
            <?php } ?>
        </table>
        <p>
            <a href="formulariocliente.php">Inserir Cliente</a>
        </p>
    </body>
</html>