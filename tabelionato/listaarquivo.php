<?php
    $cliente = $_REQUEST['cliente'];
    $sql = "select c.nome, c.cpf, d.conteudo, d.id from cliente c join documento d on d.cliente = c.id where c.id = '$cliente'; ";
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
            <a href="listacliente.php">Arquivos</a>
        </p>
        <h2>Lista de Arquivos para Cliente <?php print $resultado[0]['nome']; ?></h2>
            <?php foreach( $resultado as $tupla ) { ?>
                <div class="imagem">
                    <a href="removearquivo.php?id=<?php print $tupla['id']; ?>">&#9746;</a>
                    <img src="data:image/png;base64,<?php print $tupla['conteudo']; ?>" />
                </div>
            <?php } ?>
    </body>
</html>