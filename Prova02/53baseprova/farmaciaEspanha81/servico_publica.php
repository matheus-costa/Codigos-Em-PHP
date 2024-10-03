<?php
	$txt = file_get_contents('php://input'); 
	$obj = json_decode( $txt, true ); 
	$anvisa = $obj ['anvisa']; 
	$cpf = $obj['cpf']; 
    $conexao = new pdo ('sqlite:banco.sqlite');
	
    $sql = "
       SELECT v.cliente vc
 	   FROM Venda v
 	   JOIN Cliente c
     	ON c.id = vc
       JOIN Produto p
   	     ON p.id = vp
     	WHERE c.cpf = '$cpf' AND p.anvisa = '$anvisa' LIMIT 3);";
    
    $resultado = $conexao->query($sql)->fetchAll();
	$obj = [ 'desconto' => false ];
    if ( count($resultado) > 0 ) {
        $obj = [ 'desconto' => true ];
    }
    $txt = json_encode( $obj );
    print $txt;
