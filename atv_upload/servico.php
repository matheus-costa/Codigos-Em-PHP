<?php
    var_dump($REQUEST);
    var_dump($_FILES);
  
    $caminho = $_FILES ['arquivo']['tmp_name'];
    $conteudo = file_get_contents($caminho);
    $imagens = base64_encode($conteudo);
    $descricao = $_REQUEST['descricao'];
    $id = $_REQUEST['id'];

    $conexao = new pdo('sqilite3:banco');
    $sql = "insert into rep_imagens values ( 
                null, 
                '".$descricao."', 
                '".$imagens."'
            );"; 
    
            $resultado = $conexao->exec($sql);
            unset($conexao);
            if ( $resultado ) {
                print 'inserido com sucesso';
            } else {
                print 'erro ao inserir';
            }
            
    $sql2 = "select imagens, descricao  
             from rep_imagens
             where id = '".$id."' ";
             
            $resultado2 = $conexao->exec($sql2);
            unset($conexao);
            $resultado3 = base64_decode($resultado2);                 
        ?>
<img height="50" src="data:image/png;base64,<?php print($codificado); ?>" />