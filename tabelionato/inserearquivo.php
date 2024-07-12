<?php
    
    $caminho = $_FILES['arquivo']['tmp_name'];
    $conteudo = file_get_contents( $caminho );
    $codificado = base64_encode( $conteudo );
    $cliente = $_REQUEST['cliente'];

    $conexao = new pdo('sqlite:tab');
    $sql = "insert into documento values ( 
                null, 
                '".$cliente."', 
                '".$codificado."'
            );";
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
            <p>Arquivo inserido com sucesso.</p>
        <?php } else { ?>
            <p>Não foi possível inserir o arquivo. Tente novamente.</p>
        <?php } ?>
    </body>
</html>