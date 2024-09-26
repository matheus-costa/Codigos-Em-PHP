<?php
    $conexao = new pdo ('sqlite:db');
    $consulta = " select cpf, nome from pessoa order by nome; ";
    $resultado = $conexao->query($consulta)->fetchAll();
    unset($conexao);
    //var_dump($resultado);
?>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Lista de Procurados</h1>
        <table border="1">
            <tr>
                <th>CPF</th>
                <th>Nome</th>
            </tr>
<?php
    foreach ( $resultado as $tupla ) {
?>
            <tr>
                <td><?php print $tupla['cpf']; ?></td>
                <td><?php print $tupla['nome']; ?></td>
                <td>
                    <a href="procurado_delete.php?cpf=<?php print $tupla['cpf']; ?>">
                        X
                    </a>
                </td>
            </tr>
<?php
    }
?>
        </table>
        <p>
            <a href="procurado_cadastro.php">Cadastrar</a>
        </p>
    </body>
</html>