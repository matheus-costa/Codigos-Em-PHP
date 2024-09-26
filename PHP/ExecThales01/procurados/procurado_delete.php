<?php

    $cpf = $_REQUEST['cpf'];
    $delete = " delete from pessoa where cpf = '$cpf'; ";
    $conexao = new pdo ('sqlite:db');
    $resultado = $conexao->exec($delete);
    unset($conexao);
    if ( $resultado > 0 ) {
        print 'Removido com sucesso.';
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