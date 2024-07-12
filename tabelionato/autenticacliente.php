<?php
    $sql = "select id, nome, cpf from cliente;";
    $conexao = new pdo ('sqlite:tab');
    $resultado = $conexao->query($sql)->fetchAll(2);
    unset($conexao);
?>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="tabelionato.css" />
</head>

<body>
    <p>
        <a href="listacliente.php">Cliente</a>
    </p>
    <p>A identificação desta imagem no repositório de imagens é <?php print $_REQUEST['assinaturaid']; ?>.</p>
    <p>Aqui você deve consumir o serviço web do sistema de respositório de imagens para recuperar a imagem
        correspondente a esta identificação e mostrá-la na tela.</p>
    <p>O usuário vai indicar abaixo a conformidade da assinatura ou não.</p>
    <p>
        <a href="erro.php">Falso</a>
        <a href="formularioarquivo.php?cliente=<?php print $_REQUEST['id']; ?>">Verdadeiro</a>
    </p>
</body>

</html>