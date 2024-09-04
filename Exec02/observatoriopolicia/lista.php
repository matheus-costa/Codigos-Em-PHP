<?php
    $conexao = new pdo('sqlite:banco');
    
    $sql = " select count(*) pend from ocorrencia where resposta is null; ";
    $resultado = $conexao->query($sql)->fetchAll(2);
    $pendencias = $resultado[0]['pend'];

    $sql = " select id, local, descricao, criacao, resposta from ocorrencia order by criacao desc; ";
    $resultado = $conexao->query($sql)->fetchAll(2);

    unset($conexao);
?>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Ocorrências</h1>
        <table border="1" style="width: 100%;">
            <tr>
                <td>Local</td>
                <td>Descrição</td>
                <td>Criação</td>
                <td>Resposta</td>
                <td>Responder</td>
            </tr>
<?php   foreach ( $resultado as $tupla ) {  ?>
            <tr>
                <td><?php print $tupla['local']; ?></td>
                <td><?php print $tupla['descricao']; ?></td>
                <td><?php print $tupla['criacao']; ?></td>
                <td><?php print $tupla['resposta']; ?></td>
<?php   if (empty($tupla['resposta']) ) { ?>
                <td><a href="responder.php?id=<?php print $tupla['id']; ?>">🚓</a></td>
<?php   } else { ?>
                <td> &nbsp; </td>
<?php   } ?>
            </tr>
<?php   } ?>
        </table>
        <p> <a href="formulario.php">Registrar Manualmente</a> </p>
    </body>
</html>
<?php if ( $pendencias > 0 ) { ?>
<script>
    setInterval(
        function () {
            var body = document.getElementsByTagName('body')[0];
            if ( body.style.backgroundColor != 'red' ) {
                body.style.backgroundColor = 'red';
            } else {
                body.style.backgroundColor = 'blue';
            }
        }, 250
    );
</script>
<?php } ?>