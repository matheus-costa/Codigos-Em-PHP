<?php

    $cpf = $_REQUEST['cpf'];
    $nome = $_REQUEST['nome'];
    $insert = " insert into pessoa values ('$cpf', '$nome'); ";
    $conexao = new pdo ('sqlite:db');
    $resultado = $conexao->exec($insert);
    unset($conexao);
    if ( $resultado > 0 ) {
        print 'Inserido com sucesso.';
?>
        <script>
            setTimeout( function () {
                window.location = '/procurado_lista.php';
            }, 2000 );
        </script>
<?php
    } else {
        print 'Erro. Tente novamente.';
    }