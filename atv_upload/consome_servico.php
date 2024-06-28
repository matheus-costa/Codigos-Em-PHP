<?php
    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );
    $id = $obj['id'];
    $conexao = new pdo ('sqlite:banco');
    $resultado = $conexao->query($consulta)->fetchAll(2);
    $txt = json_encode( $resultado );
    print $txt;
      
?>